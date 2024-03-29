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
 * Class EmployeeAttendance
 * 
 * @property int $id
 * @property int|null $fk_employee
 * @property Carbon|null $date
 * @property Carbon|null $clock_in
 * @property Carbon|null $clock_out
 * @property string|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Employee|null $employee
 *
 * @package App\Models
 */
class EmployeeAttendance extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'employee_attendance';

	protected $casts = [
		'fk_employee' => 'int',
		'date' => 'date',
		'clock_in' => 'date',
		'clock_out' => 'date',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_employee',
		'date',
		'clock_in',
		'clock_out',
		'status',
		'active'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'fk_employee');
	}
}
