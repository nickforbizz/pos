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
 * Class Supplier
 * 
 * @property int $id
 * @property int|null $fk_tenant
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $contact_person
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Tenant|null $tenant
 *
 * @package App\Models
 */
class Supplier extends BaseModel
{
	use SoftDeletes, HasFactory;
	protected $table = 'suppliers';

	protected $casts = [
		'fk_tenant' => 'int',
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_tenant',
		'name',
		'email',
		'phone',
		'address',
		'contact_person',
		'status',
		'active'
	];

	public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}
}
