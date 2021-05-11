<?php

namespace App\Traits;

trait uploadFileTrait {
    public function uploadImage($image)
    {
        return cloudinary()->upload($image->getRealPath())->getSecurePath();
    }
}