<?php
    namespace App\Models\Base;
    class StockWarehouse extends \App\Models\Core\StockWarehouse {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (StockWarehouse $model) {});
            static::saving(function (StockWarehouse $model) {});
            static::deleting(function (StockWarehouse $model) {});
        }
    }
