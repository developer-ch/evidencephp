<?php

namespace App\Traits;

use Intervention\Image\ImageManagerStatic as Image;

trait ImageHandler
{
    use FileHandler;
    
    //Redimensionar imagens grandes para 768x1024
    public function resize(string $pathName, $height = 768, $width = 1024)
    {
        try {
            $directoryBase = $this->getDirStorage();
            $pathFile = $directoryBase->path($pathName);
            $img = Image::make($pathFile);

            $dimensionImg = $img->getSize()->width * $img->getSize()->height;
            $dimensionMax = $width * $height;

            if (!($dimensionImg <= $dimensionMax))
                $img->resize($width, $height);

            $img->save();
        } finally {
        }
    }

    public function insertDateTime(string $pathName){
        try {
            $directoryBase = $this->getDirStorage();
            $pathFile = $directoryBase->path($pathName);
            $img = Image::make($pathFile);
            $img->text(date_format(now(), 'd/m/Y H:i:s'), $img->getSize()->width - 190, $img->getSize()->height * 0.99, function ($font) {
                $font->file(public_path("fonts\Roboto\Roboto-Bold.ttf"));
                $font->size(20);
                $font->color([255, 255, 0]);
            });
            $img->save();
        } finally {
        }
    }

    public function cut(string $pathName, $height, $width)
    {
        try {
            $directoryBase = $this->getDirStorage();
            $pathFile = $directoryBase->path($pathName);
            $img = Image::make($pathFile);
            $img->fit($width, $height)->save();
        } finally {
        }
    }

    public function rotatet(string $pathName, $angle)
    {
        try {
            $directoryBase = $this->getDirStorage();
            $pathFile = $directoryBase->path($pathName);
            $img = Image::make($pathFile);
            $img->rotate($angle)->save();
        } finally {
        }
    }
}