<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class VendingItem extends Model {
  protected $table = 'vending_items';
  protected $appends = ['offer_id'];
  protected $hidden = [
    'vending_id',
    'cartinventory_id'
  ];

  function getOfferidAttribute() {
    return $this->vending_id.'_'.$this->cartinventory_id;
  }

  public function vending() {
    return $this->belongsTo('App\Vending');
  }

  public function attributes() {
    return $this->belongsTo('App\CartInventory', 'cartinventory_id');
  }

}
