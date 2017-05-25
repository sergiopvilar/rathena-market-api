<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BuyingItem extends Model {
  protected $table = 'buyingstore_items';

  protected $hidden = [
    'buyingstore_id'
  ];

}
