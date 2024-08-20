<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MpesaSTK extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];
    protected $table = 'mpesa_s_t_k_s';
}
