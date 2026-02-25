<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
     protected $fillable = ['name', 'description', 'status'];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    
    public function users()
    {
        return $this->belongsToMany(User::class, 'memberships')->withPivot('joined_at', 'left_at', 'role')->withTimestamps();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function expenses()
    {
        return $this->hasManyThrough(Expense::class, Category::class);
    }
}
