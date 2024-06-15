<?php
    namespace App\Models\Base;
    class InvoiceType extends \App\Models\Core\InvoiceType {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (InvoiceType $model) {});
            static::saving(function (InvoiceType $model) {});
            static::deleting(function (InvoiceType $model) {});
        }
    }
