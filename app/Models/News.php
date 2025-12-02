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
use Spatie\Translatable\HasTranslations;

class News extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;
    public $translatable = ['title', 'body'];
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('news')
            ->useDisk('news')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png', 'image/svg']);
            });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        try {
            $this->addMediaConversion('thumb')
                ->width(400)->height(400)
                ->sharpen(5)
                ->optimize()
                ->performOnCollections('news');

            $this->addMediaConversion('card')
                ->width(1200)->height(1200 * (1 / 2))
                ->sharpen(5)
                ->optimize()
                ->performOnCollections('news');
        } catch (InvalidManipulation $e) {

            Log::error($e->getMessage());
        }
    }

    public function getNewsThumbImage()
    {
        return !is_null($this->getFirstMedia('news')) ? $this->getFirstMedia('news')->getUrl('thumb') : asset('images/placeholder_category_1x1.png');
    }
    public function getNewsCardImage()
    {
        return !is_null($this->getFirstMedia('news')) ? $this->getFirstMedia('news')->getUrl('card') : asset('images/placeholder_category_1x1.png');
    }


    public function getTitleTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->title_ru;
                break;
            case 'tk':
                return $this->title_tk;
                break;
            case 'en':
                return $this->title_en;
                break;

            default:
                # code...
                break;
        }
    }

    public function getBodyTranslationAttr($locale)
    {
        switch ($locale) {
            case 'ru':
                return $this->body_ru;
                break;
            case 'tk':
                return $this->body_tk;
                break;
            case 'en':
                return $this->body_en;
                break;

            default:
                break;
        }
    }

    //
}
