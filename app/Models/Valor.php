<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    use HasFactory;
    protected $table = 'valor';
    protected $guarded = [];

    public function institucional()
    {
        return $this->belongsTo(Institucional::class);
    }
}
