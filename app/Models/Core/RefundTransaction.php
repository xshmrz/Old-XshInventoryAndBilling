<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RefundTransaction
 *
 * @property int|null $id
 * @property int|null $original_transaction_id
 * @property float|null $amount
 * @property Carbon|null $refund_date
 * @property int|null $status_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property OnlinePaymentTransaction|null $onlinePaymentTransaction
 * @property PaymentStatus|null $paymentStatus
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereOriginalTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereRefundDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RefundTransaction withoutTrashed()
 * @mixin \Eloquent
 */
class RefundTransaction extends Model
{
	use SoftDeletes;
	protected $table = 'refund_transaction';
	public static $snakeAttributes = false;

	protected $casts = [
		'original_transaction_id' => 'int',
		'amount' => 'float',
		'refund_date' => 'datetime',
		'status_id' => 'int'
	];

	protected $fillable = [
		'original_transaction_id',
		'amount',
		'refund_date',
		'status_id'
	];

	public function onlinePaymentTransaction()
	{
		return $this->belongsTo(OnlinePaymentTransaction::class, 'original_transaction_id');
	}

	public function paymentStatus()
	{
		return $this->belongsTo(PaymentStatus::class, 'status_id');
	}
}
