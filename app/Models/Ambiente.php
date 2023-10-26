<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    protected $table = 'ambiente';
    protected $guarded = [];
    
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
