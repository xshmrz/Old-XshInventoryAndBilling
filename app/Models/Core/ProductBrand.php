<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductBrand
 *
 * @property int|null $id
 * @property string|null $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductBrand withoutTrashed()
 * @mixin \Eloquent
 */
class ProductBrand extends Model
{
	use SoftDeletes;
	protected $table = 'product_brand';
	public static $snakeAttributes = false;

	protected $fillable = [
		'name'
	];
}
