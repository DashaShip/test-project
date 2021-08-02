<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $super
 * @property int|null $image_id
 * @property string $published_at
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
 */
class Post extends Model
{
    use HasFactory;
    use ImageTrait;

    protected $table = 'posts';

    protected $fillable = [
        'name',
        'description',
        'super',
        'image_id',
        'published_at',
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
     * @return int
     */
    public function getSuper(): int
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
     * @return string
     */
    public function getPublishedAt(): string
    {
        return $this->published_at;
    }

    /**
     * @param string $published_at
     */
    public function setPublishedAt(string $published_at)
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

}
