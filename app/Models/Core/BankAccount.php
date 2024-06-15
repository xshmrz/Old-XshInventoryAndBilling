<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BankAccount
 *
 * @property int|null $id
 * @property string|null $account_number
 * @property string|null $bank_name
 * @property string|null $branch_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount withoutTrashed()
 * @mixin \Eloquent
 */
class BankAccount extends Model
{
	use SoftDeletes;
	protected $table = 'bank_account';
	public static $snakeAttributes = false;

	protected $fillable = [
		'account_number',
		'bank_name',
		'branch_name'
	];
}
