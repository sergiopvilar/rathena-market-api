<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BuyingStore extends Model {
  protected $table = 'buyingstores';

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

  public static function item($item) {
    $buying_ids = BuyingItem::where('item_id', $item)->pluck('buyingstore_id');
    return BuyingStore::retrieve(BuyingStore::where('id', $buying_ids)->get());
  }

}
