<?php
    namespace App\Models\Base;
    class Invoice extends \App\Models\Core\Invoice {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Invoice $model) {});
            static::saving(function (Invoice $model) {});
            static::deleting(function (Invoice $model) {});
        }
    }
