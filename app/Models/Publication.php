<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Publication extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['title', 'content'];

    /**
     * The users that belong to the Publication.
     * Represents authors or associated users.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
