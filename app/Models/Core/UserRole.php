<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserRole
 *
 * @property int|null $id
 * @property int|null $user_id
 * @property int|null $role_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property User|null $user
 * @property Role|null $role
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole withoutTrashed()
 * @mixin \Eloquent
 */
class UserRole extends Model
{
	use SoftDeletes;
	protected $table = 'user_role';
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
