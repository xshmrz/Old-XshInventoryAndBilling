<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaymentStatus
 *
 * @property int|null $id
 * @property string|null $status_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus whereStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentStatus withoutTrashed()
 * @mixin \Eloquent
 */
class PaymentStatus extends Model
{
	use SoftDeletes;
	protected $table = 'payment_status';
	public static $snakeAttributes = false;

	protected $fillable = [
		'status_name'
	];
}
