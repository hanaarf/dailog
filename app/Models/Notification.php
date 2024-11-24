<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['from_id', 'to_id','message'];

    
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
