<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    protected $table = 'books';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
