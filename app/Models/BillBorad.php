<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class BillBorad extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * These are the fields you allow for mass assignment (e.g. via create() or update()).
     */
    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'location',
        'photo_path',
        'available_from',
        'available_to',
        'price_per_day',
        'price_per_month',
        'status',
    ];
    

    /**
     * Cast dates so Eloquent treats them as Carbon instances.
     */
    protected $dates = [
        'available_from',
        'available_to',
    ];

    /**
     * Default attributes.
     */
    protected $attributes = [
        'status' => 'available',
    ];

    /**
     * Relationships.
     */

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Example: if you create bookings later
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'billboard_id');
    }
}
