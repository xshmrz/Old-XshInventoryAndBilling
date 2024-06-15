<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductFeature
 *
 * @property int|null $id
 * @property int|null $product_id
 * @property string|null $feature_name
 * @property string|null $feature_value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Product|null $product
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereFeatureName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereFeatureValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeature withoutTrashed()
 * @mixin \Eloquent
 */
class ProductFeature extends Model
{
	use SoftDeletes;
	protected $table = 'product_feature';
	public static $snakeAttributes = false;

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'feature_name',
		'feature_value'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
