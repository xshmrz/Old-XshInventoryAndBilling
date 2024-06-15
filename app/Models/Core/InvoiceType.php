<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InvoiceType
 *
 * @property int|null $id
 * @property string|null $type_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType whereTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceType withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceType extends Model
{
	use SoftDeletes;
	protected $table = 'invoice_type';
	public static $snakeAttributes = false;

	protected $fillable = [
		'type_name'
	];
}
