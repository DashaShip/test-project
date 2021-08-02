<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Models\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property int|null $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product filter(array $frd)
 * @property-read \App\Models\File|null $file
 * @property int|null $category_id индетификатор категории
 * @method static Builder|Product whereCategoryId($value)
 * @property-read \App\Models\Category|null $Category
 */
class Product extends Model
{
    use HasFactory;
    use ImageTrait;

    protected $table = 'product';

    /**
     * @var string[]
     */
    protected $fillable =[
        'name',
        'description',
        'price',
        'image_id',
        'category_id',
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
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
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
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt()
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

                case 'category_id':
                {
                    $query->where(static function (Builder $query) use ($value) {
                        return $query->where('category_id','=',$value);
                    });
                }
                    break;
            }
        }
        return $query;
    }



    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }



}
