<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Settings
 *
 * @property int|null $id
 * @property string|null $key
 * @property string|null $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings withoutTrashed()
 * @mixin \Eloquent
 */
class Settings extends Model
{
	use SoftDeletes;
	protected $table = 'settings';
	public static $snakeAttributes = false;

	protected $fillable = [
		'key',
		'value'
	];
}
