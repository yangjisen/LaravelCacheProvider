<?php

namespace YangJiSen\CacheUserProvider;

use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return bool
     */
    protected function CacheForget($user)
    {
        $user = optional($user);
        $key = 'CacheUserProvider.single';
        if(config('cache-user.cache_channel') === 'every') {
            $second = $user->getAuthIdentifierName() ?? 'every';
            $key = "CacheUserProvider.{$second}.{$user->{$user->getAuthIdentifierName()}}";
        }
        return Cache::forget($key);
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return void
     */
    public function created($user)
    {
        $this->CacheForget($user);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return void
     */
    public function updated($user)
    {
        $this->CacheForget($user);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return void
     */
    public function deleted($user)
    {
        $this->CacheForget($user);
    }

}
