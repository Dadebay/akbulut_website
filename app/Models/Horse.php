<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Horse extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 'breed', 'age', 'height', 'color',
        'gender', 'description', 'video_path', 'sort_order',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('horse_images')
            ->useDisk('horses')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/jpeg', 'image/png', 'image/webp']);
            });

        $this->addMediaCollection('horse_video')
            ->useDisk('horse_videos')
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['video/mp4', 'video/quicktime', 'video/avi', 'video/webm']);
            });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)->height(300)
            ->performOnCollections('horse_images');

        $this->addMediaConversion('card')
            ->width(800)->height(600)
            ->performOnCollections('horse_images');
    }

    /** First image or null */
    public function getCoverImageUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('horse_images');
        return $media ? $media->getUrl('card') : null;
    }

    /** All horse images as URL array */
    public function getImageUrlsAttribute(): array
    {
        return $this->getMedia('horse_images')->map(fn($m) => $m->getUrl())->toArray();
    }

    /** Video URL */
    public function getVideoUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('horse_video');
        return $media ? $media->getUrl() : null;
    }
}
