<?php
    namespace App\Models\Base;
    class OnlinePaymentTransaction extends \App\Models\Core\OnlinePaymentTransaction {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (OnlinePaymentTransaction $model) {});
            static::saving(function (OnlinePaymentTransaction $model) {});
            static::deleting(function (OnlinePaymentTransaction $model) {});
        }
    }
