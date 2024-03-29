<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);
    }
}

class TenantScope implements Scope
{


    public function apply(Builder $builder, Model $model)
    {

        if ((Auth::check() && Auth::user()->tenant_id) && !auth()->user()->hasAnyRole('superadmin')) {
            $builder->where('tenant_id', Auth::user()->tenant_id);
        }
    }
}
