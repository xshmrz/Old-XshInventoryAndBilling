<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountType
 *
 * @property int|null $id
 * @property string|null $type_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType withoutTrashed()
 * @mixin \Eloquent
 */
class AccountType extends Model
{
	use SoftDeletes;
	protected $table = 'account_type';
	public static $snakeAttributes = false;

	protected $fillable = [
		'type_name'
	];
}
