<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (app()->getLocale() == 'ru') {
            $title_string = (string)$this->title_ru;
            $body_string = (string)$this->body_ru;

        } else if (app()->getLocale() == 'en') {

            $title_string = $this->title_en;
            $body_string = (string)$this->body_en;
        } else {

            $title_string = $this->title_tk;
            $body_string = (string)$this->body_tk;
        }

        return [
            'id' => (int)$this->id,
            'title'=> $title_string,
            'body'=>$body_string,
            'photos'=>[
                'thumb'=>$this->getNewsThumbImage(),
                'original'=>$this->getNewsCardImage(),

            ],
            'posted_date'=>date('d-m-Y', strtotime($this->created_at))
        ];
    }
}
