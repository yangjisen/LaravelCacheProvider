<?php


namespace YangJiSen\CacheUserProvider;

use Illuminate\Support\Facades\Cache;

class CacheForget
{
    /**
     * Handle the user "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return bool
     */
    public static function CacheForget($user)
    {
        $model = class_basename($user) ?? 'Model';
        $user = optional($user);
        $second = $user->getAuthIdentifierName() ?? 'every';

        $key = (config('cache-user.cache_channel') === 'every')
            ? "CacheUserProvider:{$model}:{$second}:{$user->{$user->getAuthIdentifierName()}}"
            : "CacheUserProvider:{$model}:single";


        return Cache::forget($key);
    }
}
