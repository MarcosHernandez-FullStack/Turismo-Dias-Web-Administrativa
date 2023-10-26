<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucional extends Model
{
    use HasFactory;
    protected $table = 'institucional';
    protected $guarded = [];

    public function valores()
    {
        return $this->hasMany(Valor::class);
    }
}
