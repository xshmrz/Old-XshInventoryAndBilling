<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 *
 * @property int|null $id
 * @property int|null $invoice_id
 * @property int|null $payment_method_id
 * @property float|null $amount
 * @property Carbon|null $date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Invoice|null $invoice
 * @property InvoicePaymentMethod|null $invoicePaymentMethod
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment withoutTrashed()
 * @mixin \Eloquent
 */
class Payment extends Model
{
	use SoftDeletes;
	protected $table = 'payment';
	public static $snakeAttributes = false;

	protected $casts = [
		'invoice_id' => 'int',
		'payment_method_id' => 'int',
		'amount' => 'float',
		'date' => 'datetime'
	];

	protected $fillable = [
		'invoice_id',
		'payment_method_id',
		'amount',
		'date'
	];

	public function invoice()
	{
		return $this->belongsTo(Invoice::class);
	}

	public function invoicePaymentMethod()
	{
		return $this->belongsTo(InvoicePaymentMethod::class, 'payment_method_id');
	}
}
