<?php
    namespace App\Models\Base;
    class StockMovement extends \App\Models\Core\StockMovement {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (StockMovement $model) {});
            static::saving(function (StockMovement $model) {});
            static::deleting(function (StockMovement $model) {});
        }
    }
