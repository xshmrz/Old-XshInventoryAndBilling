<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CashType
 *
 * @property int|null $id
 * @property string|null $type_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|CashType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CashType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashType whereTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CashType withoutTrashed()
 * @mixin \Eloquent
 */
class CashType extends Model
{
	use SoftDeletes;
	protected $table = 'cash_type';
	public static $snakeAttributes = false;

	protected $fillable = [
		'type_name'
	];
}
