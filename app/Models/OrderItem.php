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
 * Class OrderItem
 * 
 * @property int $id
 * @property int|null $fk_tenant
 * @property int|null $fk_order
 * @property int|null $fk_product
 * @property int|null $quantity
 * @property float|null $unit_price
 * @property float|null $amount
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Order|null $order
 * @property Product|null $product
 * @property Tenant|null $tenant
 *
 * @package App\Models
 */
class OrderItem extends BaseModel
{
	use SoftDeletes, HasFactory;
	protected $table = 'order_items';

	protected $casts = [
		'fk_tenant' => 'int',
		'fk_order' => 'int',
		'fk_product' => 'int',
		'quantity' => 'int',
		'unit_price' => 'float',
		'amount' => 'float',
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_tenant',
		'fk_order',
		'fk_product',
		'quantity',
		'unit_price',
		'amount',
		'status',
		'active'
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'fk_order');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'fk_product');
	}

	public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}
}
