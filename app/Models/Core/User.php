<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 *
 * @property int|null $id
 * @property string|null $username
 * @property string|null $password_hash
 * @property string|null $email
 * @property int|null $role_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @property Role|null $role
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Model
{
	use SoftDeletes;
	protected $table = 'user';
	public static $snakeAttributes = false;

	protected $casts = [
		'role_id' => 'int'
	];

	protected $fillable = [
		'username',
		'password_hash',
		'email',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
