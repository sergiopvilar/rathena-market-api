<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BuyingItem extends Model {
  protected $table = 'buyingstore_items';

  protected $hidden = [
    'buyingstore_id'
  ];

  public static function get_all($where1, $where2) {
    $items = BuyingItem::where($where1, $where2)->get();
    return $items;
  }

}
