<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class VendingItem extends Model {
  protected $table = 'vending_items';

  protected $hidden = [
    'vending_id',
    'cartinventory_id'
  ];

  public function vending() {
    return $this->belongsTo('App\Vending');
  }

  public function attributes() {
    return $this->belongsTo('App\CartInventory', 'cartinventory_id');
  }

}
