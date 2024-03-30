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
 * Class Expense
 * 
 * @property int $id
 * @property int|null $fk_tenant
 * @property Carbon|null $date
 * @property float|null $amount
 * @property string|null $category
 * @property string|null $description
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
class Expense extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'expenses';

	protected $casts = [
		'fk_tenant' => 'int',
		'date' => 'date',
		'amount' => 'float',
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_tenant',
		'date',
		'amount',
		'category',
		'description',
		'status',
		'active'
	];

	public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}
}
