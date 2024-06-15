<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CreditCardInfo
 *
 * @property int|null $id
 * @property int|null $user_id
 * @property string|null $card_number
 * @property string|null $cardholder_name
 * @property string|null $expiry_date
 * @property string|null $cvv
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property User|null $user
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereCardholderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereCvv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardInfo withoutTrashed()
 * @mixin \Eloquent
 */
class CreditCardInfo extends Model
{
	use SoftDeletes;
	protected $table = 'credit_card_info';
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'card_number',
		'cardholder_name',
		'expiry_date',
		'cvv'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
