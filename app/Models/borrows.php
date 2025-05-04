<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class borrows extends Model
{
    protected $table = 'borrows';

    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(books::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
