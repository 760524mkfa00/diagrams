<?php namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'label'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo($permission)
    {
        return $this->permissions()->sync($permission);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assignRoleTo($user)
    {
        return $this->users()->sync($user);
    }
}
