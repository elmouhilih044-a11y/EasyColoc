<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
   protected $fillable = ['email', 'token', 'colocation_id', 'invited_by', 'status'];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
