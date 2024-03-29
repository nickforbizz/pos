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
 * Class EmployeeSalary
 * 
 * @property int $id
 * @property int|null $fk_employee
 * @property float|null $amount
 * @property string|null $pay_frequency
 * @property Carbon|null $pay_date
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Employee|null $employee
 *
 * @package App\Models
 */
class EmployeeSalary extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'employee_salaries';

	protected $casts = [
		'fk_employee' => 'int',
		'amount' => 'float',
		'pay_date' => 'date',
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_employee',
		'amount',
		'pay_frequency',
		'pay_date',
		'status',
		'active'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'fk_employee');
	}
}
