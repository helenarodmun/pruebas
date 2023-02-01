<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //Se define la relación entre usuario y perfil de forma inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
