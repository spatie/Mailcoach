<?php

namespace App\Support\AppConfiguration;

use App\Support\ConfigCache;
use Illuminate\Config\Repository;
use Spatie\Valuestore\Valuestore;

class AppConfiguration
{
    protected Valuestore $valuestore;

    protected Repository $config;

    public function __construct(
        Valuestore $valuestore,
        Repository $config
    ) {
        $this->valuestore = $valuestore;
        $this->config = $config;
    }

    public function put(array $values)
    {
        $this->valuestore->flush();

        return $this->valuestore->put($values);
    }

    public function all()
    {
        return $this->valuestore->all();
    }

    public function __get(string $property)
    {
        return $this->valuestore->get($property);
    }

    public function registerConfigValues()
    {
        config()->set('app.name', $this->valuestore->get('name', config('app.name')));
        config()->set('app.url', $this->valuestore->get('url', config('app.url')));

        ConfigCache::clear();
    }
}
