<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BuyingItem extends Model {
  protected $table = 'buyingstore_items';

  protected $hidden = [
    'buyingstore_id',
    'item_id'
  ];

  protected $appends = ['attributes', 'offer_id'];

  function getOfferidAttribute() {
    return $this->buyingstore_id;
  }

  function getAttributesAttribute() {
    return (object) [
      'item_id' => $this->item_id,
      'refine' => 0,
      'strong' => 0,
      'cards' => [],
      'elemental' => ''
    ];
  }

}
