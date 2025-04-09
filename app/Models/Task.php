<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to search tasks.
     *
     * @param Builder $query
     * @param string|null $searchKey
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $searchKey): Builder
    {
        if ($searchKey) {
            return $query->where(function ($q) use ($searchKey) {
                $q->where('title', 'like', "%{$searchKey}%");
            });
        }

        return $query;
    }
}
