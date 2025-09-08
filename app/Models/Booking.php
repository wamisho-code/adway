<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'billboard_id',
        'advertiser_id',
        'owner_id',
        'video_path',
        'start_date',
        'end_date',
        'price',
        'payment_status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
        'created_at' => 'datetime',
    ];
   

    // Relationships

    public function billboard()
    {
        return $this->belongsTo(Billborad::class); 
    }

    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id'); 
    }
}

