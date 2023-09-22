<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
    ];

    /**
     * All reservations of customer
     *
     * @return HasMany
     */
    public function reservations():HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Return the full name
     *
     * @return string
     */
    public function getFullNameAttribute():string
    {
        return implode(" ", [$this->name, $this->last_name]);
    }
}
