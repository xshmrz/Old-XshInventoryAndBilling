<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountBalance
 *
 * @property int|null $id
 * @property int|null $account_id
 * @property float|null $balance
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Account|null $account
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountBalance withoutTrashed()
 * @mixin \Eloquent
 */
class AccountBalance extends Model
{
	use SoftDeletes;
	protected $table = 'account_balance';
	public static $snakeAttributes = false;

	protected $casts = [
		'account_id' => 'int',
		'balance' => 'float'
	];

	protected $fillable = [
		'account_id',
		'balance'
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}
}
