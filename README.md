### 安装

```shell
composer require "yangjisen/laravel-cache-provider"
```

### Laravel 应用

* 在 `config/app.php` 注册 ServiceProvider (Laravel 5.5 + 无需手动注册) 

```php
'providers' => [
    /*
    * Package Service Providers...
    */
    YangJiSen\CacheUserProvider\ServiceProvider::class,
]
```

* 创建配置文件:

```shell
php artisan vendor:publish --provider="YangJiSen\CacheUserProvider\ServiceProvider"
```

* 配置文件说明
```php
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 缓存的保存时间
    |--------------------------------------------------------------------------
    |
    | 默认值:   3600
    |
    */
    'cache_ttl' => env('CACHE_USER_TTL', 3600),

    /*
    |--------------------------------------------------------------------------
    | 缓存的保存方式
    |--------------------------------------------------------------------------
    |
    | single:   所有的保存为一个缓存键值
    | every:    按照单个用户进行缓存
    |
    */
    'cache_channel' => env('CACHE_USER_CHANNEL', 'every'),
    
    /*
    |--------------------------------------------------------------------------
    | 渴望加载的关联模型
    |--------------------------------------------------------------------------
    |
    | String: a,b,c
    |
    | 使用关联加载时,关联的数据仅在第一次查询时加载,缓存后不会自动进行更新,需要自行实现关联更新时删除缓存数据
    |
    | @param  \Illuminate\Database\Eloquent\Model  $user
    | 调用删除方法: YangJiSen\CacheUserProvider\CacheForget::CacheForget($user);
    |
    */
    'model_with' => env('CACHE_USER_MODEL_WITH'),
];
```

* 将配置文件 `config/auth.php` 中 将授权提供者的驱动修改为 `cache` 即可

```php
'providers' => [
    'users' => [
        'driver' => 'cache',
        'model' => App\User::class,
    ],
]
```
