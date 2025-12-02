<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;
    public $translatable = ['caption'];

    protected $guarded = [];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('galleries')
            ->useDisk('galleries')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png','image/svg']);
            })->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        try {
            $this->addMediaConversion('thumb')
                ->width(400)->height(400)
                ->sharpen(5)

                // ->crop('crop-center', 400, 400)
                ->performOnCollections('galleries');

            $this->addMediaConversion('card')
                ->width(1500)->height(1500)
                ->sharpen(5)

                //   ->crop('crop-center',800,800)
                ->performOnCollections('galleries');

        } catch (InvalidManipulation $e) {

            Log::error($e->getMessage());

        }
    }

    public function getGalleryThumbImage()
    {
        return !is_null($this->getFirstMedia('galleries')) ? $this->getFirstMedia('galleries')->getUrl('thumb') : asset('images/profile.png');
    }
    public function getGalleryCardImage()
    {
        return !is_null($this->getFirstMedia('galleries')) ? $this->getFirstMedia('galleries')->getUrl('card') : asset('images/profile.png');
    }


    public function getCaptionTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->caption_ru;
                break;
            case 'tk':
                return $this->caption_tk;
                break;
            case 'en':
                return $this->caption_en;
                break;

            default:
                break;
        }
    }

}
