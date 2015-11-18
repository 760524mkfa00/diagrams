<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['name', 'street','town','postal','province','country','description','telephone'];

    Public function plans()
    {
        return $this->hasMany('Plans\Plan');
    }

    Public function pictures()
    {
        return $this->hasMany('Plans\Picture');
    }
}
