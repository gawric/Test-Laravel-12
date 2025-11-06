<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hunting extends Model
{
    use HasFactory;

    protected $table = 'hunting';
    protected $fillable = [
        'tour_name',
        'hunter_name',
        'guide_id',
        'date',
        'participants_count',
    ];

  
    protected $casts = [
        'date' => 'date',
        'participants_count' => 'unsignedSmallInteger',
        'guide_id' => 'unsignedInteger',
    ];

 
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

  
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now());
    }
}
