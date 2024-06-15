<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 *
 * @property int|null $id
 * @property string|null $name
 * @property int|null $type_id
 * @property string $contact_info
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property AccountType|null $accountType
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account withoutTrashed()
 * @mixin \Eloquent
 */
class Account extends Model
{
	use SoftDeletes;
	protected $table = 'account';
	public static $snakeAttributes = false;

	protected $casts = [
		'type_id' => 'int'
	];

	protected $fillable = [
		'name',
		'type_id',
		'contact_info'
	];

	public function accountType()
	{
		return $this->belongsTo(AccountType::class, 'type_id');
	}
}
