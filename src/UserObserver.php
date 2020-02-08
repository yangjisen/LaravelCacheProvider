<?php

namespace YangJiSen\CacheUserProvider;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return void
     */
    public function created($user)
    {
        CacheForget::CacheForget($user);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return void
     */
    public function updated($user)
    {
        CacheForget::CacheForget($user);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $user
     * @return void
     */
    public function deleted($user)
    {
        CacheForget::CacheForget($user);
    }

}
