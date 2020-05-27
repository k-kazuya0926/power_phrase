<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;

class Like extends Model
{
    use CounterCache;

    public $counterCacheOptions = [
        'Entry' => [
            'field' => 'likes_count',
            'foreignKey' => 'entry_id'
        ]
    ];

    protected $fillable = ['user_id', 'entry_id'];

    public function entry()
    {
      return $this->belongsTo('App\Entry');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

}
