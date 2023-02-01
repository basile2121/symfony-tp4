<?php
namespace App\Service;
use Psr\Cache\CacheItemInterface;


class HaschService
{
    public function hashData(string $data, int $lenght = null): string
    {
        if ($lenght !== null) {
            return substr(md5($data), 0, $lenght);
        }
        return md5($data);
    }
}