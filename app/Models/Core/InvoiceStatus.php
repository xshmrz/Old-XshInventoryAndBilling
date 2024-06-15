<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InvoiceStatus
 *
 * @property int|null $id
 * @property string|null $status_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus whereStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceStatus withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceStatus extends Model
{
	use SoftDeletes;
	protected $table = 'invoice_status';
	public static $snakeAttributes = false;

	protected $fillable = [
		'status_name'
	];
}
