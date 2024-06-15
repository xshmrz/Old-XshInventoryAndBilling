<?php
    namespace App\Models\Base;
    class Permission extends \App\Models\Core\Permission {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Permission $model) {});
            static::saving(function (Permission $model) {});
            static::deleting(function (Permission $model) {});
        }
    }
