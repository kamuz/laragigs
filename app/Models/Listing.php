<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'tags', 'email', 'website', 'description'];

    public function scopeFilter($query, array $filters) {

        // Show posts by tag
        if($filters['tag'] ?? false){
            // dd($filters['tag']);
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // Seach request
        if($filters['search'] ?? false){
            // dd($filters['search']);
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
}