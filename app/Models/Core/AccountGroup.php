<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Core;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccountGroup
 *
 * @property int|null $id
 * @property string|null $group_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 * @package App\Models\Core
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountGroup withoutTrashed()
 * @mixin \Eloquent
 */
class AccountGroup extends Model
{
	use SoftDeletes;
	protected $table = 'account_group';
	public static $snakeAttributes = false;

	protected $fillable = [
		'group_name'
	];
}
