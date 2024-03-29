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
 * Class Customer
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $company
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Customer extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'customers';

	protected $casts = [
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'phone',
		'address',
		'company',
		'status',
		'active'
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'fk_customer');
	}
}
