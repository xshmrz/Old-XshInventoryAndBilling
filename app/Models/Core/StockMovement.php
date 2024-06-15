<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockMovement
 *
 * @property int|null $id
 * @property int|null $product_id
 * @property int|null $warehouse_id
 * @property string|null $movement_type
 * @property int|null $quantity
 * @property Carbon|null $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Product|null $product
 * @property StockWarehouse|null $stockWarehouse
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereMovementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement whereWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMovement withoutTrashed()
 * @mixin \Eloquent
 */
class StockMovement extends Model
{
	use SoftDeletes;
	protected $table = 'stock_movement';
	public static $snakeAttributes = false;

	protected $casts = [
		'product_id' => 'int',
		'warehouse_id' => 'int',
		'quantity' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'product_id',
		'warehouse_id',
		'movement_type',
		'quantity',
		'date'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function stockWarehouse()
	{
		return $this->belongsTo(StockWarehouse::class, 'warehouse_id');
	}
}
