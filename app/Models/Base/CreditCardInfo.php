<?php
    namespace App\Models\Base;
    class CreditCardInfo extends \App\Models\Core\CreditCardInfo {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (CreditCardInfo $model) {});
            static::saving(function (CreditCardInfo $model) {});
            static::deleting(function (CreditCardInfo $model) {});
        }
    }
