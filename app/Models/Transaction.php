<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'fk_tenant',
        'fk_order',
        'payment_method',
        'amount',
        'mpesa_transaction_id',
        'cash_transaction_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function tenant()
	{
		return $this->belongsTo(Tenant::class, 'fk_tenant');
	}
}
