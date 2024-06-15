<?php
    namespace App\Models\Base;
    class InvoiceDetail extends \App\Models\Core\InvoiceDetail {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (InvoiceDetail $model) {});
            static::saving(function (InvoiceDetail $model) {});
            static::deleting(function (InvoiceDetail $model) {});
        }
    }
