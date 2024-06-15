<?php
    namespace App\Models\Base;
    class RefundTransaction extends \App\Models\Core\RefundTransaction {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (RefundTransaction $model) {});
            static::saving(function (RefundTransaction $model) {});
            static::deleting(function (RefundTransaction $model) {});
        }
    }
