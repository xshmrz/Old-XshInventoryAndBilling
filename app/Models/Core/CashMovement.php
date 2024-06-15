<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CashMovement
 *
 * @property int|null $id
 * @property int|null $account_id
 * @property string|null $movement_type
 * @property float|null $amount
 * @property Carbon|null $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Account|null $account
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereMovementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CashMovement withoutTrashed()
 * @mixin \Eloquent
 */
class CashMovement extends Model
{
	use SoftDeletes;
	protected $table = 'cash_movement';
	public static $snakeAttributes = false;

	protected $casts = [
		'account_id' => 'int',
		'amount' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'account_id',
		'movement_type',
		'amount',
		'date'
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}
}
