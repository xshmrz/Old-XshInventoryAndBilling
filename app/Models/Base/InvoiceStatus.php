<?php
    namespace App\Models\Base;
    class InvoiceStatus extends \App\Models\Core\InvoiceStatus {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (InvoiceStatus $model) {});
            static::saving(function (InvoiceStatus $model) {});
            static::deleting(function (InvoiceStatus $model) {});
        }
    }
