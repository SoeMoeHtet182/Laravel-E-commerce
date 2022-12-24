<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_amount', 'level'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
