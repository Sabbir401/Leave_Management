<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function role()
    {
        return $this->belongsTo(User::class, 'Role_Id');
    }
}
