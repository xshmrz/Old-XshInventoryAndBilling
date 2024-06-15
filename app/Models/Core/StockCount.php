<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockCount
 *
 * @property int|null $id
 * @property int|null $warehouse_id
 * @property int|null $product_id
 * @property int|null $counted_quantity
 * @property Carbon|null $count_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property StockWarehouse|null $stockWarehouse
 * @property Product|null $product
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereCountDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereCountedQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount whereWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCount withoutTrashed()
 * @mixin \Eloquent
 */
class StockCount extends Model
{
	use SoftDeletes;
	protected $table = 'stock_count';
	public static $snakeAttributes = false;

	protected $casts = [
		'warehouse_id' => 'int',
		'product_id' => 'int',
		'counted_quantity' => 'int',
		'count_date' => 'datetime'
	];

	protected $fillable = [
		'warehouse_id',
		'product_id',
		'counted_quantity',
		'count_date'
	];

	public function stockWarehouse()
	{
		return $this->belongsTo(StockWarehouse::class, 'warehouse_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
