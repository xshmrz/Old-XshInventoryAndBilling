<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InvoicePaymentMethod
 *
 * @property int|null $id
 * @property string|null $method_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod whereMethodName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePaymentMethod withoutTrashed()
 * @mixin \Eloquent
 */
class InvoicePaymentMethod extends Model
{
	use SoftDeletes;
	protected $table = 'invoice_payment_method';
	public static $snakeAttributes = false;

	protected $fillable = [
		'method_name'
	];
}
