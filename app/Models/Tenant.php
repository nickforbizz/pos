<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tenant
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $domain
 * @property string|null $email
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Tenant extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'tenants';

	protected $casts = [
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'name',
		'domain',
		'email',
		'status',
		'active'
	];
}
