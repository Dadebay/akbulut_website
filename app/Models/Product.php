<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;


class Product extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public $translatable = ['general_info', 'description','name'];

    protected $guarded = [];

    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')
            ->useDisk('products')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png']);
            });

        $this->addMediaCollection('product_sliders')
            ->useDisk('product_sliders')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png']);
            });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        try {
            $this->addMediaConversion('thumb')
                ->width(400)->height(400)
                ->sharpen(5)
                ->optimize()
                // ->crop('crop-center', 400, 400)
                ->performOnCollections('products');

            $this->addMediaConversion('card')
                ->width(800)->height(800)
                ->sharpen(5)
                ->optimize()
                //   ->crop('crop-center',800,800)
                ->performOnCollections('products');

        } catch (InvalidManipulation $e) {

            Log::error($e->getMessage());

        }
    }

    public function getProductCardImage()
    {
        return !is_null($this->getFirstMedia('products')) ? $this->getFirstMedia('products')->getUrl('card') :  asset('images/placeholder_category_1x1.png');
    }

    public function getProductThumbImage()
    {
        return !is_null($this->getFirstMedia('products')) ? $this->getFirstMedia('products')->getUrl('thumb') :  asset('images/placeholder_category_1x1.png');
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

    public function getGeneralInfoTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->general_info_ru;
                break;
            case 'tk':
                return $this->general_info_tk;
                break;
            case 'en':
                return $this->general_info_en;
                break;

            default:
                break;
        }
    }

    public function getDescTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->description_ru;
                break;
            case 'tk':
                return $this->description_tk;
                break;
            case 'en':
                return $this->description_en;
                break;

            default:
                break;
        }
    }
}

