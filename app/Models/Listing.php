<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    public function scopeFilter($query, array $filters) {

        if($filters['tags'] ?? false) {

            $tags = array_keys($filters['tags']);
            foreach($tags as $tag) {
                $query->whereHas('tags', function(Builder $query) use($tag) {
                    $query->where('name', '=', $tag);
                });
            }

        }


        if($filters['search'] ?? false) {

            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
        }

    }

    // Relationship To User

    public function user() {

        return $this->belongsTo(User::class, 'user_id');

    }

    // Relationship To Application

    public function applications() {

        return $this->hasMany(Application::class, 'listing_id');

    }

    // Relationship To Tags

    public function tags() {

        return $this->belongsToMany(Tag::class, 'listings_tags');

    }
}
