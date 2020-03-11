<?php

namespace App\Support;

use Illuminate\Contracts\Filesystem\Filesystem;

class Cache
{
    public static function clear()
    {
        /** @var \Illuminate\Filesystem\Filesystem $filesystem */
        $filesystem = app(Filesystem::class);

        $cacheConfigPath = app()->getCachedConfigPath();

        if (file_exists($cacheConfigPath)) {
            $filesystem->delete($cacheConfigPath);
        }
    }
}
