<?php
    namespace App\Models\Base;
    class StockCount extends \App\Models\Core\StockCount {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (StockCount $model) {});
            static::saving(function (StockCount $model) {});
            static::deleting(function (StockCount $model) {});
        }
    }
