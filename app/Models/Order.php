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
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * Class Order
 * 
 * @property int $id
 * @property int|null $fk_customer
 * @property int|null $fk_employee
 * @property Carbon|null $order_date
 * @property float|null $total_amount
 * @property string|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Customer|null $customer
 * @property Employee|null $employee
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Order extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'orders';

	protected $casts = [
		'fk_customer' => 'int',
		'fk_employee' => 'int',
		'order_date' => 'date',
		'total_amount' => 'float',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_customer',
		'fk_employee',
		'order_date',
		'total_amount',
		'status',
		'active'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class, 'fk_customer');
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'fk_employee');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class, 'fk_order');
	}
}
