<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Exceptions\InvalidManipulation;
use Illuminate\Support\Facades\Log;

class Slider extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'sliders';

    protected $fillable = [
        'caption_ru',
        'caption_tk',
        'caption_en',
        'desc_en',
        'desc_tk',
        'desc_ru',

    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('home_sliders')
            ->useDisk('home_sliders')
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
                ->optimize()
                ->sharpen(5)
                //->crop('crop-center', 367, 367)
                ->performOnCollections('home_sliders');

            $this->addMediaConversion('card')
                ->width(1200)->height(800*0.7)
                ->sharpen(5)
                // ->crop('crop-center',1200,800*0.7)
                ->performOnCollections('home_sliders');

        } catch (InvalidManipulation $e) {

            Log::error($e->getMessage());

        }
    }

    public function getSliderCardImage()
    {
        return !is_null($this->getFirstMedia('home_sliders')) ? $this->getFirstMedia('home_sliders')->getUrl('card') : asset('images/profile.png');
    }

    public function getDescTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->desc_ru;
                break;
            case 'tk':
                return $this->desc_tk;
                break;
            case 'en':
                return $this->desc_en;
                break;

            default:
                break;
        }
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
