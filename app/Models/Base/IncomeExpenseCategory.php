<?php
    namespace App\Models\Base;
    class IncomeExpenseCategory extends \App\Models\Core\IncomeExpenseCategory {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (IncomeExpenseCategory $model) {});
            static::saving(function (IncomeExpenseCategory $model) {});
            static::deleting(function (IncomeExpenseCategory $model) {});
        }
    }
