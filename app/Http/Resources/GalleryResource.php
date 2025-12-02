<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (app()->getLocale() == 'ru') {
            $caption_string = (string)$this->caption_ru;
        } else if (app()->getLocale() == 'en') {

            $caption_string = $this->caption_en;
        } else {

            $caption_string = $this->caption_tk;
        }
        return [
            'id' => (int)$this->id,
            'caption' => $caption_string,
            'thumb' => $this->getGalleryThumbImage(),
            'card' => $this->getGalleryCardImage(),
        ];
    }
}
