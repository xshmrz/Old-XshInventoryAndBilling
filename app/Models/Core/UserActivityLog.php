<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserActivityLog
 *
 * @property int|null $id
 * @property int|null $user_id
 * @property string|null $activity
 * @property Carbon|null $timestamp
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property User|null $user
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivityLog withoutTrashed()
 * @mixin \Eloquent
 */
class UserActivityLog extends Model
{
	use SoftDeletes;
	protected $table = 'user_activity_log';
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int',
		'timestamp' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'activity',
		'timestamp'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
