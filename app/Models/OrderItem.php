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
 * @property int|null $fk_order
 * @property int|null $fk_product
 * @property int|null $quantity
 * @property float|null $selling_price
 * @property int|null $status
 * @property int|null $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Order|null $order
 * @property Product|null $product
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'order_items';

	protected $casts = [
		'fk_order' => 'int',
		'fk_product' => 'int',
		'quantity' => 'int',
		'selling_price' => 'float',
		'status' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'fk_order',
		'fk_product',
		'quantity',
		'selling_price',
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
}
