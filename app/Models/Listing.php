<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $logo
 * @property string $tags
 * @property string $company
 * @property string $location
 * @property string $email
 * @property string $website
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ListingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Listing whereWebsite($value)
 * @mixin \Eloquent
 */
class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'tags', 'email', 'website', 'description', 'logo', 'user_id'];

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

    // Relationship to user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}