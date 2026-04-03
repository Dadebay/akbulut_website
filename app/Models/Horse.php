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

    /**
     * Make a media URL relative so it works on any domain
     * (local 127.0.0.1 or production server).
     */
    private function relativeUrl(string $url): string
    {
        $appUrl = rtrim(config('app.url'), '/');
        if (str_starts_with($url, $appUrl)) {
            return substr($url, strlen($appUrl));
        }
        // Fallback: strip scheme+host from any absolute URL
        $parsed = parse_url($url);
        return ($parsed['path'] ?? '/') . (isset($parsed['query']) ? '?' . $parsed['query'] : '');
    }

    /** First image URL (relative) or null */
    public function getCoverImageUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('horse_images');
        return $media ? $this->relativeUrl($media->getUrl()) : null;
    }

    /** All image URLs (relative) */
    public function getImageUrlsAttribute(): array
    {
        return $this->getMedia('horse_images')
            ->map(fn($m) => $this->relativeUrl($m->getUrl()))
            ->toArray();
    }

    /** Video URL (relative) or null */
    public function getVideoUrlAttribute(): ?string
    {
        $media = $this->getFirstMedia('horse_video');
        return $media ? $this->relativeUrl($media->getUrl()) : null;
    }
}
