<?php
    namespace App\Models\Base;
    class AccountContact extends \App\Models\Core\AccountContact {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (AccountContact $model) {});
            static::saving(function (AccountContact $model) {});
            static::deleting(function (AccountContact $model) {});
        }
    }
