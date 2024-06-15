<?php
    namespace App\Models\Base;
    class AccountType extends \App\Models\Core\AccountType {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (AccountType $model) {});
            static::saving(function (AccountType $model) {});
            static::deleting(function (AccountType $model) {});
        }
    }
