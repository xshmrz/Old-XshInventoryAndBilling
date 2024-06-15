<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InvoiceDetail
 *
 * @property int|null $id
 * @property int|null $invoice_id
 * @property int|null $product_id
 * @property int|null $quantity
 * @property float|null $unit_price
 * @property float|null $total_price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Invoice|null $invoice
 * @property Product|null $product
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceDetail withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceDetail extends Model
{
	use SoftDeletes;
	protected $table = 'invoice_detail';
	public static $snakeAttributes = false;

	protected $casts = [
		'invoice_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int',
		'unit_price' => 'float',
		'total_price' => 'float'
	];

	protected $fillable = [
		'invoice_id',
		'product_id',
		'quantity',
		'unit_price',
		'total_price'
	];

	public function invoice()
	{
		return $this->belongsTo(Invoice::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
