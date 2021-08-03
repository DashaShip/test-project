<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\String_;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $super
 * @property int|null $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSuper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\File|null $file
 * @property-read \App\Models\File|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $files
 * @property-read int|null $files_count
 * @method static Builder|Post filter(array $frd)
 * @property Carbon $published_at
 */
class Post extends Model
{
    use HasFactory;
    use ImageTrait;
    use HasTrixRichText;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'description',
        'super',
        'image_id',
        'published_at',
        'post-trixFields',
        'attachment-post-trixFields'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'super'=>'boolean',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isSuper(): Bool
    {
        return $this->super;
    }

    /**
     * @param int $super
     */
    public function setSuper(int $super): void
    {
        $this->super = $super;
    }

    /**
     * @return int|null
     */
    public function getImageId(): ?int
    {
        return $this->image_id;
    }

    /**
     * @param int|null $image_id
     */
    public function setImageId(?int $image_id): void
    {
        $this->image_id = $image_id;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getPublishedAt(): \Carbon\Carbon
    {
        return $this->published_at;
    }

    /**
     * @param $published_at
     */
    public function setPublishedAt($published_at)
    {
        $this->published_at = $published_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Builder $query
     * @param array $frd
     * @return Builder
     */
    public  function scopeFilter(Builder $query, array $frd)
    {
        foreach ($frd as $key => $value) {
            if (null === $value) {
                continue;
            }


            switch ($key) {
                case 'search':
                    {
                        $query->where(static function (Builder $query) use ($value) {
                            return $query->where('name', 'like', '%'. $value. '%');
                        });
                    }
                    break;
            }
        }
        return $query;
    }

    /**
     * @return HasOne
     */
    public function file(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'image_id');
    }

    /**
     * @return BelongsToMany
     */
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'posts_images', 'post_id', 'file_id');
    }

    /**
     * @return Collection
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    /**
     * @param array $files
     */
    public function uploadGallery(array $files): void
    {
        $this->files()->delete();
        foreach ($files as $key => $file) {
            /** @var Storage $storage */
            $storage = Storage::disk('public');
            $name = Str::slug($this->getName()).'-'.$this->getKey().'-'.$key.'.jpg';
            $path = 'images/'.$name;
            Storage::disk('public')->delete($path);
            $storage->put($path, $file->get());
            $path.='?'.Carbon::now();
            $file = $this->files()->create([
                'user_id'=>auth()->id(),
                'name'=>$name,
                'path'=>$path,
            ]);
        }
    }

    /**
     * @return string|null
     */
    public function getFilesPath(): ?string
    {
        $result = null;
        if ($this->getFiles() !== null) {
            $result = '/storage/'.$this->getFile()->getPath();
        }
        return $result;
    }

    /**
     * @param string|null $name
     * @return string
     */
    public function getTrixContent(?string $name = null)
    {
        if ($name === null) {
            $content = $this->trixRichText();
        } else {
            $content = $this->trixRichText()->where('field', $name);
        }
        return $content->first()->content ?? '';
    }
}
