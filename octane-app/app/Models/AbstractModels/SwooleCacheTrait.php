<?php

namespace App\Models\AbstractModels;

use Laravel\Octane\Facades\Octane;

trait SwooleCacheTrait
{
    public static function rememberSwooleForever($key, $callback)
    {
        $cachedData = Octane::table('cache')->get($key);
        if (!$cachedData) {
            $data = $callback();
            Octane::table('cache')->set($key, ['value' => serialize($data), 'expiration' => -1]);
            return $data;
        }
        return unserialize($cachedData['value']);
    }

    public static function forgetSwoole($key)
    {
        Octane::table('cache')->delete($key);
    }
}
