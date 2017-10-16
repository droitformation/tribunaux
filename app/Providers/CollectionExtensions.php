<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class CollectionExtensions extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('sortAccent', function ($key, $collate) {

            $data = collect($this->items)->pluck($key,'id');
            $data = $data->toArray();

            $coll = new \Collator($collate);
            $coll->asort($data);

            $ids = array_keys($data);

            return collect($this->items)->sortBy(function($model) use ($ids){
                return array_search($model->getKey(), $ids);
            });

        });

        collect()->macro('mapWithKeys_v2', function ($callback) {

            $result = [];

            foreach ($this->items as $key => $value) {
                $assoc = $callback($value, $key);

                foreach ($assoc as $mapKey => $mapValue) {
                    $result[$mapKey] = $mapValue;
                }
            }

            return new static($result);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
