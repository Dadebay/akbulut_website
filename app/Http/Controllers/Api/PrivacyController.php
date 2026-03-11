<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivacyResource;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $aboutUs = Privacy::first();
        return new PrivacyResource($aboutUs);
    }
}
