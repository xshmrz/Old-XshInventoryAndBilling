<?php
    namespace App\Models\Base;
    class Expense extends \App\Models\Core\Expense {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Expense $model) {});
            static::saving(function (Expense $model) {});
            static::deleting(function (Expense $model) {});
        }
    }
