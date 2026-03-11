<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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

        } else if (app()->getLocale() == 'en') {

            $name_string = (string)$this->name_en;

        } else {

            $name_string = (string)$this->name_tk;
        }
        return [
            'id' => (int)$this->id,
            // 'name'=>$this->name,
            'name' => (string)$name_string,
            'parent_id' => (int)$this->parent_id,
            'type' => (string)$this->type,
            'hasChildren' => $this->children->count() > 0,
            'children' => Category::collection($this->children),
            'image' => $this->getCategoryCardImage(),
            'products_count' => (int)$this->products->count()
        ];
    }
}
