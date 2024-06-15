<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaymentProvider
 *
 * @property int|null $id
 * @property string|null $provider_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider withoutTrashed()
 * @mixin \Eloquent
 */
class PaymentProvider extends Model
{
	use SoftDeletes;
	protected $table = 'payment_provider';
	public static $snakeAttributes = false;

	protected $fillable = [
		'provider_name'
	];
}
