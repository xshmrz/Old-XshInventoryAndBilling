<?php
    namespace App\Models\Base;
    class Income extends \App\Models\Core\Income {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Income $model) {});
            static::saving(function (Income $model) {});
            static::deleting(function (Income $model) {});
        }
    }
