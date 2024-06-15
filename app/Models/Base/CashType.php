<?php
    namespace App\Models\Base;
    class CashType extends \App\Models\Core\CashType {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (CashType $model) {});
            static::saving(function (CashType $model) {});
            static::deleting(function (CashType $model) {});
        }
    }
