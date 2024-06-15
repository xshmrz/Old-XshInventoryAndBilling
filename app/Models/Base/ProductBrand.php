<?php
    namespace App\Models\Base;
    class ProductBrand extends \App\Models\Core\ProductBrand {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (ProductBrand $model) {});
            static::saving(function (ProductBrand $model) {});
            static::deleting(function (ProductBrand $model) {});
        }
    }
