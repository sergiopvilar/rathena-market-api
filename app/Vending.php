<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Vending extends Model {
  protected $table = 'vendings';

  protected $hidden = [
    'body_direction',
    'head_direction',
    'sit',
    'sex',
    'char_id',
    'account_id',
  ];

  public function char() {
    return $this->belongsTo('App\Char', 'char_id');
  }

  public function items() {
    return $this->hasMany('App\VendingItem');
  }

}
