<?php
    namespace App\Models\Base;
    class Account extends \App\Models\Core\Account {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Account $model) {});
            static::saving(function (Account $model) {});
            static::deleting(function (Account $model) {});
        }
    }
