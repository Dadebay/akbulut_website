<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    use HasFactory;
    public $translatable = ['body'];
    protected $guarded = [];

    public function getBodyTransArr($locale)
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
}
