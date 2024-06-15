<?php
    namespace App\Models\Base;
    class PaymentMethod extends \App\Models\Core\PaymentMethod {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (PaymentMethod $model) {});
            static::saving(function (PaymentMethod $model) {});
            static::deleting(function (PaymentMethod $model) {});
        }
    }
