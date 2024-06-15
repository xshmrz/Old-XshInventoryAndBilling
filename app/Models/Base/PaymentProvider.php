<?php
    namespace App\Models\Base;
    class PaymentProvider extends \App\Models\Core\PaymentProvider {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (PaymentProvider $model) {});
            static::saving(function (PaymentProvider $model) {});
            static::deleting(function (PaymentProvider $model) {});
        }
    }
