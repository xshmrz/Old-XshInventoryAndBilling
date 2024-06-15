<?php
    namespace App\Models\Base;
    class PaymentStatus extends \App\Models\Core\PaymentStatus {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (PaymentStatus $model) {});
            static::saving(function (PaymentStatus $model) {});
            static::deleting(function (PaymentStatus $model) {});
        }
    }
