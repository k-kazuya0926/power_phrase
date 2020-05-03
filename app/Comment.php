<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment'];

    public function entry() {
        return $this->belongsTo('App\Entry');
    }
}
