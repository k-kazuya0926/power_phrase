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

    public function Entry()
    {
      return $this->belongsTo('App\Entry');
    }

    public function User()
    {
      return $this->belongsTo(User::class);
    }

}
