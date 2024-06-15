<?php
    namespace App\Models\Base;
    class CashMovement extends \App\Models\Core\CashMovement {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (CashMovement $model) {});
            static::saving(function (CashMovement $model) {});
            static::deleting(function (CashMovement $model) {});
        }
    }
