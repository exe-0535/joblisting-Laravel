<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Relationship to Listings

    public function listings() {

        return $this->belongsToMany(Listing::class, 'listings_tags');

    }
}
