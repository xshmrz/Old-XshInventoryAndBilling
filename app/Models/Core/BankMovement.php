<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BankMovement
 *
 * @property int|null $id
 * @property int|null $bank_account_id
 * @property string|null $movement_type
 * @property float|null $amount
 * @property Carbon|null $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property BankAccount|null $bankAccount
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereBankAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereMovementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankMovement withoutTrashed()
 * @mixin \Eloquent
 */
class BankMovement extends Model
{
	use SoftDeletes;
	protected $table = 'bank_movement';
	public static $snakeAttributes = false;

	protected $casts = [
		'bank_account_id' => 'int',
		'amount' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'bank_account_id',
		'movement_type',
		'amount',
		'date'
	];

	public function bankAccount()
	{
		return $this->belongsTo(BankAccount::class);
	}
}
