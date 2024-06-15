<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InvoiceSeries
 *
 * @property int|null $id
 * @property string|null $series_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries whereSeriesCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoiceSeries withoutTrashed()
 * @mixin \Eloquent
 */
class InvoiceSeries extends Model
{
	use SoftDeletes;
	protected $table = 'invoice_series';
	public static $snakeAttributes = false;

	protected $fillable = [
		'series_code'
	];
}
