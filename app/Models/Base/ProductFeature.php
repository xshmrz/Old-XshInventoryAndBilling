<?php
    namespace App\Models\Base;
    class ProductFeature extends \App\Models\Core\ProductFeature {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (ProductFeature $model) {});
            static::saving(function (ProductFeature $model) {});
            static::deleting(function (ProductFeature $model) {});
        }
    }
