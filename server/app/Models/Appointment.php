<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['doctor', 'description', 'user_id'];

    protected $table = 'appointments';

    public function user() {
        return $this->hasMany(User::class);
    }
}
