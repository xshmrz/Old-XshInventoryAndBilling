<?php
    namespace App\Models\Base;
    class InvoicePaymentMethod extends \App\Models\Core\InvoicePaymentMethod {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (InvoicePaymentMethod $model) {});
            static::saving(function (InvoicePaymentMethod $model) {});
            static::deleting(function (InvoicePaymentMethod $model) {});
        }
    }
