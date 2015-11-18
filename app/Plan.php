<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['plan'];

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    Public function floors()
    {
        return $this->belongsTo('Plans\Floor');
    }
}
