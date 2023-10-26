<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamacion extends Model
{
    use HasFactory;
    protected $table = 'libro_reclamacion';
    protected $guarded = [];
}
