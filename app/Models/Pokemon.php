<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [ 'nome', 'peso', 'tipo', 'user_id' ];
    public $timestamps = false;
}
