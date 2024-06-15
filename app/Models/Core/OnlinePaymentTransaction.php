<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OnlinePaymentTransaction
 *
 * @property int|null $id
 * @property int|null $invoice_id
 * @property int|null $payment_method_id
 * @property float|null $amount
 * @property Carbon|null $transaction_date
 * @property int|null $status_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Invoice|null $invoice
 * @property PaymentMethod|null $paymentMethod
 * @property PaymentStatus|null $paymentStatus
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OnlinePaymentTransaction withoutTrashed()
 * @mixin \Eloquent
 */
class OnlinePaymentTransaction extends Model
{
	use SoftDeletes;
	protected $table = 'online_payment_transaction';
	public static $snakeAttributes = false;

	protected $casts = [
		'invoice_id' => 'int',
		'payment_method_id' => 'int',
		'amount' => 'float',
		'transaction_date' => 'datetime',
		'status_id' => 'int'
	];

	protected $fillable = [
		'invoice_id',
		'payment_method_id',
		'amount',
		'transaction_date',
		'status_id'
	];

	public function invoice()
	{
		return $this->belongsTo(Invoice::class);
	}

	public function paymentMethod()
	{
		return $this->belongsTo(PaymentMethod::class);
	}

	public function paymentStatus()
	{
		return $this->belongsTo(PaymentStatus::class, 'status_id');
	}
}
