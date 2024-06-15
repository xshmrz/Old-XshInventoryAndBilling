<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IncomeExpenseType
 *
 * @property int|null $id
 * @property string|null $type_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType whereTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseType withoutTrashed()
 * @mixin \Eloquent
 */
class IncomeExpenseType extends Model
{
	use SoftDeletes;
	protected $table = 'income_expense_type';
	public static $snakeAttributes = false;

	protected $fillable = [
		'type_name'
	];
}
