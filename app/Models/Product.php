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
 * Class Product
 * 
 * @property int $id
 * @property int|null $fk_tenant
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property float $cost_price
 * @property string $quantity
 * @property string $color
 * @property string $size
 * @property string $label
 * @property string $photo
 * @property int $created_by
 * @property int $category_id
 * @property string $active
 * @property string $status
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property float|null $selling_price
 * 
 * @property ProductCategory $product_category
 * @property User $user
 * @property Tenant|null $tenant
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Product extends BaseModel
{
	use SoftDeletes, HasFactory;
	protected $table = 'products';

	protected $casts = [
		'fk_tenant' => 'int',
		'cost_price' => 'float',
		'created_by' => 'int',
		'category_id' => 'int',
		'selling_price' => 'float'
	];

	protected $fillable = [
		'fk_tenant',
		'title',
		'slug',
		'description',
		'cost_price',
		'quantity',
		'color',
		'size',
		'label',
		'make',
		'photo',
		'created_by',
		'category_id',
		'active',
		'status',
		'selling_price'
	];

	public function product_category()
	{
		return $this->belongsTo(ProductCategory::class, 'category_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class, 'fk_product');
	}
}
