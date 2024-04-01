<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'permission'
    ];

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_group_permissions');
    }
}
