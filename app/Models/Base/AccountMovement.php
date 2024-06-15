<?php
    namespace App\Models\Base;
    class AccountMovement extends \App\Models\Core\AccountMovement {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (AccountMovement $model) {});
            static::saving(function (AccountMovement $model) {});
            static::deleting(function (AccountMovement $model) {});
        }
    }
