<?php
    namespace App\Models\Base;
    class AccountGroup extends \App\Models\Core\AccountGroup {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (AccountGroup $model) {});
            static::saving(function (AccountGroup $model) {});
            static::deleting(function (AccountGroup $model) {});
        }
    }
