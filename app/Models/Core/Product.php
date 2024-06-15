<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 *
 * @property int|null $id
 * @property string|null $name
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string $description
 * @property float|null $price
 * @property int|null $stock_quantity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property ProductCategory|null $productCategory
 * @property ProductBrand|null $productBrand
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStockQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'product';
	public static $snakeAttributes = false;

	protected $casts = [
		'category_id' => 'int',
		'brand_id' => 'int',
		'price' => 'float',
		'stock_quantity' => 'int'
	];

	protected $fillable = [
		'name',
		'category_id',
		'brand_id',
		'description',
		'price',
		'stock_quantity'
	];

	public function productCategory()
	{
		return $this->belongsTo(ProductCategory::class, 'category_id');
	}

	public function productBrand()
	{
		return $this->belongsTo(ProductBrand::class, 'brand_id');
	}
}
