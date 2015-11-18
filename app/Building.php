<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['building_name', 'street','town','postal','province','country','description','telephone','building_type'];

    Public function plans()
    {
        return $this->hasMany('Plans\Plan');
    }

    Public function pictures()
    {
        return $this->hasMany('Plans\Picture');
    }

    public function scopeLocatedAt($query, $building_name, $street)
    {
        $building_name = str_replace('-', ' ', $building_name);
        $street = str_replace('-', ' ', $street);

        return $query->where(compact('building_name', 'street'));
    }


}
