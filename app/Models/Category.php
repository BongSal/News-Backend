<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected function toFilterableArray(): array
    {
        return ['title'];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
