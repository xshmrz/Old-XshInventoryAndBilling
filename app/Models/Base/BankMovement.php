<?php
    namespace App\Models\Base;
    class BankMovement extends \App\Models\Core\BankMovement {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (BankMovement $model) {});
            static::saving(function (BankMovement $model) {});
            static::deleting(function (BankMovement $model) {});
        }
    }
