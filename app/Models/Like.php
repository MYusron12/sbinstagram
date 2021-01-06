<?php

namespace App\Models;

use App\Models\LikesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory, LikesTrait;

    protected $guarded = ['id'];

    public function likeable()
    {
        return $this->morphTo();
    }
}
