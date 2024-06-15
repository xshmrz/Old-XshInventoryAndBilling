<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission
 *
 * @property int|null $id
 * @property string|null $permission_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission wherePermissionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutTrashed()
 * @mixin \Eloquent
 */
class Permission extends Model
{
	use SoftDeletes;
	protected $table = 'permission';
	public static $snakeAttributes = false;

	protected $fillable = [
		'permission_name'
	];
}
