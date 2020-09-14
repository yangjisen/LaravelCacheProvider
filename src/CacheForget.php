<?php


namespace YangJiSen\CacheUserProvider;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Cache;

class CacheForget
{
    /**
     * Handle the user "created" event.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return bool
     */
    public static function CacheForget(Authenticatable $user)
    {
        $model = class_basename($user);
        $second = $user->getAuthIdentifierName() ?? 'every';

        $key = (config('cache-user.cache_channel') === 'every')
            ? "CacheUserProvider:{$model}:{$second}:{$user->{$user->getAuthIdentifierName()}}"
            : "CacheUserProvider:{$model}:single";


        return Cache::forget($key);
    }
}
