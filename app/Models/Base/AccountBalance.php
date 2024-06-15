<?php
    namespace App\Models\Base;
    class AccountBalance extends \App\Models\Core\AccountBalance {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (AccountBalance $model) {});
            static::saving(function (AccountBalance $model) {});
            static::deleting(function (AccountBalance $model) {});
        }
    }
