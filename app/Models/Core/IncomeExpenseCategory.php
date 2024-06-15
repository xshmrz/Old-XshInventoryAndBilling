<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IncomeExpenseCategory
 *
 * @property int|null $id
 * @property string|null $category_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeExpenseCategory withoutTrashed()
 * @mixin \Eloquent
 */
class IncomeExpenseCategory extends Model
{
	use SoftDeletes;
	protected $table = 'income_expense_category';
	public static $snakeAttributes = false;

	protected $fillable = [
		'category_name'
	];
}
