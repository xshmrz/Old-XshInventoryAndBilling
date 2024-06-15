<?php
    namespace App\Models\Base;
    class UserRole extends \App\Models\Core\UserRole {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (UserRole $model) {});
            static::saving(function (UserRole $model) {});
            static::deleting(function (UserRole $model) {});
        }
    }
