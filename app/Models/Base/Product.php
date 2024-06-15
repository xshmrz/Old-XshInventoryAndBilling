<?php
    namespace App\Models\Base;
    class Product extends \App\Models\Core\Product {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Product $model) {});
            static::saving(function (Product $model) {});
            static::deleting(function (Product $model) {});
        }
    }
