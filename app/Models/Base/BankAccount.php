<?php
    namespace App\Models\Base;
    class BankAccount extends \App\Models\Core\BankAccount {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (BankAccount $model) {});
            static::saving(function (BankAccount $model) {});
            static::deleting(function (BankAccount $model) {});
        }
    }
