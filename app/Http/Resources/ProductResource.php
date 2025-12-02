<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (app()->getLocale() == 'ru') {
            $name_string = (string)$this->name_ru;
            $general_info_string = (string)$this->general_info_ru;
            $desc_string =  (string)$this->description_ru;
        } else if (app()->getLocale() == 'en') {

            $name_string = $this->name_en;
            $general_info_string = (string)$this->general_info_en;
            $desc_string =  (string)$this->description_en;
        } else {

            $name_string = $this->name_tk;
            $general_info_string = (string)$this->general_info_tk;
            $desc_string =  (string)$this->description_tk;
        }

        return [
            'id' => (int)$this->id,
            'category_id' => (int)$this->category_id,
            'name' => $name_string,
            'general_info' => $general_info_string,
            'type' => (string)$this->type,
            'description' => (string)$desc_string,
            'photos' => [
                'thumb' => $this->getProductThumbImage(),
                'original' => $this->getProductCardImage(),
            ],
            'productsliders' =>
                $this->getMedia('product_sliders')->map(function (Media $media) {
                    return [
                        'id' => (int) $media->id,
                        'original' => url($media->getUrl()),
                    ];
                }),
        ];
    }
}
