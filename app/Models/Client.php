<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    public function rentalOrders(): HasMany
    {
        return $this->hasMany(RentalOrder::class);
    }

    public function favoriteCars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'client_favorite_cars')
            ->withPivot(['client_id', 'car_id',]);
    }
}
