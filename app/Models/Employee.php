<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 * 
 * @property int $id
 * @property int|null $fk_tenant
 * @property string|null $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Tenant|null $tenant
 * @property Collection|EmployeeAttendance[] $employee_attendances
 * @property Collection|EmployeeSalary[] $employee_salaries
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Employee extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'employees';

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
		'status',
		'active'
	];

	public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}

	public function employee_attendances()
	{
		return $this->hasMany(EmployeeAttendance::class, 'fk_employee');
	}

	public function employee_salaries()
	{
		return $this->hasMany(EmployeeSalary::class, 'fk_employee');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'fk_employee');
	}
}
