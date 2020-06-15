<?php

namespace App\Http\Controllers;

use App\Media\AllowedMediaTypes;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /***
     * @return array
     */
    public function types()
    {
        return [
            'types' => AllowedMediaTypes::$allowedTypes
        ];
    }
}
