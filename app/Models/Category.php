<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Exceptions\InvalidManipulation;
use Illuminate\Support\Facades\Log;

class Category extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;
    public $translatable = ['name'];
    protected $table = 'categories';

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getCategoryImage()
    {
        return !is_null($this->getFirstMedia('categories')) ? $this->getFirstMedia('categories')->getUrl() : asset('images/placeholder_category_1x1.png');
    }

    public function getCategoryCardImage()
    {
        return !is_null($this->getFirstMedia('categories')) ? $this->getFirstMedia('categories')->getUrl('card') : asset('images/placeholder_category_1x05.png');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('categories')
            ->useDisk('categories')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png']);
            })->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        try {
            // $this->addMediaConversion('thumb')
            //     ->width(500)->height(500 * 0.6)
            //     ->nonQueued();

            $this->addMediaConversion('thumb')
                ->width(367)->height(367)
                ->sharpen(5)
                ->optimize()
                // ->crop('crop-center', 367, 367)
                ->performOnCollections('categories');

            $this->addMediaConversion('card')
                ->width(800)->height(800*0.7)
                ->sharpen(5)
                ->optimize()
                // ->crop('crop-center',800,800*0.7)
                ->performOnCollections('categories');

        } catch (InvalidManipulation $e) {

            Log::error($e->getMessage());

        }
    }

    public function getNameTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->name_ru;
                break;
            case 'tk':
                return $this->name_tk;
                break;
            case 'en':
                return $this->name_en;
                break;

            default:
                break;
        }
    }

}
