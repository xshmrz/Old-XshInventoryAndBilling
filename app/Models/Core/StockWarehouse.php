<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockWarehouse
 *
 * @property int|null $id
 * @property string|null $name
 * @property string|null $location
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockWarehouse withoutTrashed()
 * @mixin \Eloquent
 */
class StockWarehouse extends Model
{
	use SoftDeletes;
	protected $table = 'stock_warehouse';
	public static $snakeAttributes = false;

	protected $fillable = [
		'name',
		'location'
	];
}
