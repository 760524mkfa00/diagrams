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

    public function addPhoto(Picture $picture)
    {
        return $this->pictures()->save($picture);
    }

    public function addFile(Plan $plan)
    {
        return $this->plans()->save($plan);
    }

    public static function locatedAt($building_name, $street)
    {
        $building_name = str_replace('-', ' ', $building_name);
        $street = str_replace('-', ' ', $street);

        return static::where(compact('building_name', 'street'))->firstOrFail();
    }




}
