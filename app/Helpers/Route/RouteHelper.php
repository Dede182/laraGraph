<?php

namespace App\Helpers\Route;

class RouteHelper
{
    public static function includedRouteFiles(string $folder)
    {
        $dirIterator = new \RecursiveDirectoryIterator($folder);

        /** @var \RecursiveDirectoryIterator | \RecursiveIteratorIterator $it */
        $it = new \RecursiveIteratorIterator($dirIterator);

        while ($it->valid())
        {
            if (!$it->isDot()
            && $it->isFile()
            && $it->isReadable()
            && $it->current()->getExtension() === 'php')
            {
                require $it->key();
                //                require $it->current()->getPathname();
            }
            $it->next();
        }
    }
}
