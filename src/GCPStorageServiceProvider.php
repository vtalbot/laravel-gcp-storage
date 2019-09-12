<?php

namespace TalbotNinja\LaravelGCPStorage;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use TalbotNinja\FlysystemGCPStorage\GCPStorageAdapter;

class GCPStorageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['filesystem']->extend('gcp-storage', function ($app, $config) {
            $client = new StorageClient([
                'keyFilePath' => $config['key_file_path'],
            ]);

            return new Filesystem(new GCPStorageAdapter($client->bucket($config['bucket'])));
        });
    }
}
