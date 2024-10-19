<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters) {
        // Show posts by tag
        if($filters['tag'] ?? false){
            // dd($filters['tag']);
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
