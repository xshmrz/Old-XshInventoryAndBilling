<?php
    namespace App\Models\Base;
    class IncomeExpenseType extends \App\Models\Core\IncomeExpenseType {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (IncomeExpenseType $model) {});
            static::saving(function (IncomeExpenseType $model) {});
            static::deleting(function (IncomeExpenseType $model) {});
        }
    }
