<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserHasMatches extends Model
{
    use HasFactory;

    protected $table= 'user_has_matches';
    protected $primaryKey='id';
    protected $fillable = [
        'match_id',
        'user_id',
    ];

    public function matches(): BelongsTo
    {
        return $this->belongsTo(Matches::class,'match_id','id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
