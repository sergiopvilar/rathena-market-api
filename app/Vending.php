<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Vending extends Model {
  protected $table = 'vendings';
  protected $appends = ['type'];
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

  public function getTypeAttribute() {
    return 'selling';
  }

  public static function item($item) {
    $query = CartInventory::where('nameid', $item);
    $inventory_ids = $query->pluck('id');
    if($query->get()->isEmpty()) return [];
    return Vending::whereHas('items', function ($query) use($inventory_ids) {
      $query->where('cartinventory_id', $inventory_ids);
    })->get()->map(function($store) {
      return $store->load('char', 'items', 'items.attributes');
    });
  }

}
