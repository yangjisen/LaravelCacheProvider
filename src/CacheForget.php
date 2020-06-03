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
        $user = optional($user);
        $second = $user->getAuthIdentifierName() ?? 'every';

        $key = (config('cache-user.cache_channel') === 'every')
            ? "CacheUserProvider:".class_basename($model).":{$second}:{$user->{$user->getAuthIdentifierName()}}"
            : 'CacheUserProvider:'.class_basename($model).':single';


        return Cache::forget($key);
    }
}
