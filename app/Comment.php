<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';
    protected $dates = ['deleted_at'];
    protected $fillable = ['comment'];

    public function entry() {
        return $this->belongsTo('App\Entry');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
