<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountContact
 *
 * @property int|null $id
 * @property int|null $account_id
 * @property string|null $contact_type
 * @property string|null $contact_info
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Account|null $account
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereContactType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountContact withoutTrashed()
 * @mixin \Eloquent
 */
class AccountContact extends Model
{
	use SoftDeletes;
	protected $table = 'account_contact';
	public static $snakeAttributes = false;

	protected $casts = [
		'account_id' => 'int'
	];

	protected $fillable = [
		'account_id',
		'contact_type',
		'contact_info'
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}
}
