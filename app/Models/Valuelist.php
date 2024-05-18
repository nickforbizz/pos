<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Valuelist
 * 
 * @property int $id
 * @property string|null $type
 * @property int|null $index
 * @property string|null $value
 * @property int|null $created_by
 * @property bool|null $active
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class Valuelist extends Model
{
	use SoftDeletes;
	protected $table = 'valuelists';

	protected $casts = [
		'index' => 'int',
		'created_by' => 'int',
		'active' => 'bool'
	];

	protected $fillable = [
		'type',
		'index',
		'value',
		'created_by',
		'active'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
