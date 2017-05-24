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

  public static function get_all($where1, $where2) {
    $items = VendingItem::where($where1, $where2)->get();
    $return_objects = [];
    foreach($items as $item) {
      $inventory = CartInventory::where('id', $item->cartinventory_id)->first();
      array_push($return_objects, (object) [
        'item_id' => $inventory->nameid,
        'amount' => $item->amount,
        'price' => $item->price,
        'refine' => $inventory->refine,
        'created_by' => $inventory->maker(),
        'strong' => $inventory->strong(),
        'element' => $inventory->elemental(),
        'cards' => $inventory->cards(),
      ]);
    }
    return $return_objects;
  }

}
