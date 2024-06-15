<?php
	namespace App\Models\Base;
	class Settings extends \App\Models\Core\Settings {
        protected static function boot() {
            parent::boot();
            static::retrieved(function (Settings $model) {});
            static::saving(function (Settings $model) {});
            static::deleting(function (Settings $model) {});
        }
	}
