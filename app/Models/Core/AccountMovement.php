<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountMovement
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
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereMovementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountMovement withoutTrashed()
 * @mixin \Eloquent
 */
class AccountMovement extends Model
{
	use SoftDeletes;
	protected $table = 'account_movement';
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
