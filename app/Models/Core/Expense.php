<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Expense
 *
 * @property int|null $id
 * @property int|null $account_id
 * @property int|null $expense_type_id
 * @property float|null $amount
 * @property Carbon|null $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Account|null $account
 * @property IncomeExpenseType|null $incomeExpenseType
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense withoutTrashed()
 * @mixin \Eloquent
 */
class Expense extends Model
{
	use SoftDeletes;
	protected $table = 'expense';
	public static $snakeAttributes = false;

	protected $casts = [
		'account_id' => 'int',
		'expense_type_id' => 'int',
		'amount' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'account_id',
		'expense_type_id',
		'amount',
		'date'
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}

	public function incomeExpenseType()
	{
		return $this->belongsTo(IncomeExpenseType::class, 'expense_type_id');
	}
}
