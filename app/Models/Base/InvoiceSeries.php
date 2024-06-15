<?php
    namespace App\Models\Base;
    class InvoiceSeries extends \App\Models\Core\InvoiceSeries {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (InvoiceSeries $model) {});
            static::saving(function (InvoiceSeries $model) {});
            static::deleting(function (InvoiceSeries $model) {});
        }
    }
