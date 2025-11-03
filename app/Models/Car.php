<?php
// app/Models/Car.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    public function rentalOrders(): HasMany
    {
        return $this->hasMany(RentalOrder::class);
    }

    public function favoriteClients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_favorite_cars');
    }
}
