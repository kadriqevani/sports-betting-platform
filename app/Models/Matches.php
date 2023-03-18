<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $table= 'matches';
    protected $primaryKey='id';

    protected $fillable = [
        'team1',
        'team2',
        'isActive',
    ];

    public function userhasmatches() {
        return $this->hasMany(UserHasMatches::class,'match_id','id');
    }
}
