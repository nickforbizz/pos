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
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * 
 * @property int $id
 * @property int|null $fk_tenant
 * @property string $fname
 * @property string|null $lname
 * @property string|null $sname
 * @property string|null $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string $avator
 * @property string $active
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Tenant|null $tenant
 * @property Collection|Guard[] $guards
 * @property Collection|Permission[] $permissions
 * @property Collection|ProductCategory[] $product_categories
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;
	use SoftDeletes;
	protected $table = 'users';

	protected $casts = [
		'fk_tenant' => 'int',
		'email_verified_at' => 'date',
		'two_factor_confirmed_at' => 'date'
	];

	protected $hidden = [
		'password',
		'two_factor_secret',
		'remember_token'
	];

	protected $fillable = [
		'fk_tenant',
		'fname',
		'lname',
		'sname',
		'name',
		'email',
		'email_verified_at',
		'password',
		'two_factor_secret',
		'two_factor_recovery_codes',
		'two_factor_confirmed_at',
		'avator',
		'active',
		'remember_token'
	];

	public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}

	public function guards()
	{
		return $this->hasMany(Guard::class, 'created_by');
	}

	public function permissions()
	{
		return $this->hasMany(Permission::class, 'created_by');
	}

	public function product_categories()
	{
		return $this->hasMany(ProductCategory::class, 'created_by');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'created_by');
	}
}
