<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Invoice
 *
 * @property int|null $id
 * @property int|null $account_id
 * @property int|null $invoice_type_id
 * @property Carbon|null $date
 * @property Carbon|null $due_date
 * @property int|null $status_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Account|null $account
 * @property InvoiceType|null $invoiceType
 * @property InvoiceStatus|null $invoiceStatus
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice withoutTrashed()
 * @mixin \Eloquent
 */
class Invoice extends Model
{
	use SoftDeletes;
	protected $table = 'invoice';
	public static $snakeAttributes = false;

	protected $casts = [
		'account_id' => 'int',
		'invoice_type_id' => 'int',
		'date' => 'datetime',
		'due_date' => 'datetime',
		'status_id' => 'int'
	];

	protected $fillable = [
		'account_id',
		'invoice_type_id',
		'date',
		'due_date',
		'status_id'
	];

	public function account()
	{
		return $this->belongsTo(Account::class);
	}

	public function invoiceType()
	{
		return $this->belongsTo(InvoiceType::class);
	}

	public function invoiceStatus()
	{
		return $this->belongsTo(InvoiceStatus::class, 'status_id');
	}
}
