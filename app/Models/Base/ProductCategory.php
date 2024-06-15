<?php
    namespace App\Models\Base;
    class ProductCategory extends \App\Models\Core\ProductCategory {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (ProductCategory $model) {});
            static::saving(function (ProductCategory $model) {});
            static::deleting(function (ProductCategory $model) {});
        }
    }
