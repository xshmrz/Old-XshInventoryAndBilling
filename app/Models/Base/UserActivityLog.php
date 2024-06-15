<?php
    namespace App\Models\Base;
    class UserActivityLog extends \App\Models\Core\UserActivityLog {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (UserActivityLog $model) {});
            static::saving(function (UserActivityLog $model) {});
            static::deleting(function (UserActivityLog $model) {});
        }
    }
