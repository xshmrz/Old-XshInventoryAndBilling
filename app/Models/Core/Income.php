<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Income
 *
 * @property int|null $id
 * @property int|null $account_id
 * @property int|null $income_type_id
 * @property float|null $amount
 * @property Carbon|null $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Account|null $account
 * @property IncomeExpenseType|null $incomeExpenseType
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereIncomeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income withoutTrashed()
 * @mixin \Eloquent
 */
class Income extends Model
{
	use SoftDeletes;
	protected $table = 'income';
	public static $snakeAttributes = false;

	protected $casts = [
		'account_id' => 'int',
		'income_type_id' => 'int',
		'amount' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'account_id',
		'income_type_id',
		'amount',
		'date'
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}

	public function incomeExpenseType()
	{
		return $this->belongsTo(IncomeExpenseType::class, 'income_type_id');
	}
}
