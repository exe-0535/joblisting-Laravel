<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Relationship To User

    public function user() {

        return $this->belongsTo(User::class, 'user_id');

    }

    // Relationship To Listing

    public function listing() {

        return $this->belongsTo(Listing::class, 'listing_id');

    }
}
