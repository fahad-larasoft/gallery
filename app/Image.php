<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class Image extends Model
{
    protected $guarded = [];

    public function getUrlAttribute() {
        $path = Storage::path($this->name);

        $cache_image = InterventionImage::cache(function($image) use ($path) {
            return $image->make($path)->resize(300, 200)->greyscale();
        });

        return Response::make( $cache_image, 200, [ 'Content-Type' => 'image' ] )
            ->setMaxAge(604800)
            ->setPublic();
    }
}
