<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $name
 * @property string $domain
 * @property string $email
 * @property integer $status
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Customer[] $customers
 * @property EmployeeSalary[] $employeeSalaries
 * @property Employee[] $employees
 * @property Expense[] $expenses
 * @property OrderItem[] $orderItems
 * @property Order[] $orders
 * @property ProductCategory[] $productCategories
 * @property Product[] $products
 * @property Supplier[] $suppliers
 * @property User[] $users
 */
class Tenant extends Model
{

    use SoftDeletes, HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['name', 'domain', 'email', 'status', 'active', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany('App\Models\Customer', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeSalaries()
    {
        return $this->hasMany('App\Models\EmployeeSalary', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany('App\Models\Expense', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productCategories()
    {
        return $this->hasMany('App\Models\ProductCategory', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function suppliers()
    {
        return $this->hasMany('App\Models\Supplier', 'fk_tenant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'fk_tenant');
    }
}
