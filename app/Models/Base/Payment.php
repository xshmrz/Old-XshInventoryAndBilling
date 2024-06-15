<?php
    namespace App\Models\Base;
    class Payment extends \App\Models\Core\Payment {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Payment $model) {});
            static::saving(function (Payment $model) {});
            static::deleting(function (Payment $model) {});
        }
    }
