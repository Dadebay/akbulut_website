<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (app()->getLocale() == 'ru') {
            $body_string = (string)$this->body_ru;
        } else if (app()->getLocale() == 'en') {

            $body_string = $this->body_en;
        } else {

            $body_string = $this->body_tk;
        }
        return [
            'body' => $body_string,
        ];
    }
}
