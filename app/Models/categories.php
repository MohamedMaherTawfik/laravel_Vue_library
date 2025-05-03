<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = 'categories';

    protected $guarded = [];

    public function book()
    {
        return $this->hasMany(books::class);
    }
}
