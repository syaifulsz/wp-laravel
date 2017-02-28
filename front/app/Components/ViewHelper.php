<?php

namespace App\Components;

class ViewHelper
{
    public static function asset_versioning($path)
    {
        $realPath = public_path(starts_with($path, '/') ? ltrim($path, '/') : $path);

        if (!file_exists($realPath)) return !starts_with($path, '/') ? "/{$path}" : $path;

        $mtime = filemtime($realPath);
        $fileName = basename($realPath);
        $pathOnly = str_replace($fileName, '', $path);

        switch (true) {
            case (str_contains($fileName, 'css') && str_contains($fileName, 'min')) :
                $path = $pathOnly . str_replace('min.css', "{$mtime}.min.css", $fileName);
                break;

            case (str_contains($fileName, 'css')) :
                $path = $pathOnly . str_replace('css', "{$mtime}.css", $fileName);
                break;

            case (str_contains($fileName, 'js') && str_contains($fileName, 'min')) :
                $path = $pathOnly . str_replace('min.js', "{$mtime}.min.js", $fileName);
                break;

            case (str_contains($fileName, 'js')) :
                $path = $pathOnly . str_replace('js', "{$mtime}.js", $fileName);
                break;
        }

        return !starts_with($path, '/') ? "/{$path}" : $path;
    }
}
