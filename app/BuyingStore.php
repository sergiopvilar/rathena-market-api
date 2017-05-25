<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BuyingStore extends Model {
  protected $table = 'buyingstores';
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
    return $this->hasMany('App\BuyingItem', 'buyingstore_id');
  }

  public function getTypeAttribute() {
    return 'buying';
  }

  public static function item($item) {
    $query = BuyingItem::where('item_id', $item);
    $buying_ids = $query->pluck('buyingstore_id');
    if($query->get()->isEmpty()) return [];
    return BuyingStore::where('id', $buying_ids)->get()->map(function($store){
      return $store->load('char', 'items');
    });
  }

}
