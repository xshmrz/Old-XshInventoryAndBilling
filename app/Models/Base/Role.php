<?php
    namespace App\Models\Base;
    class Role extends \App\Models\Core\Role {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Role $model) {});
            static::saving(function (Role $model) {});
            static::deleting(function (Role $model) {});
        }
    }
