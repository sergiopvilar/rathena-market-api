<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CartInventory extends Model {
  protected $table = 'cart_inventory';

  protected $hidden = [
    "id", "char_id", "nameid", "amount", "equip", "identify", "option_id0", "option_val0", "option_parm0",
    "option_id1", "option_val1", "option_parm1", "option_id2", "option_val2", "option_parm2", "option_id3",
    "option_val3", "option_parm3", "option_id4", "option_val4", "option_parm4", "expire_time", "bound",
    "unique_id", "attribute", "card0", "card1", "card2", "card3"
  ];

  protected $appends = ['strong', 'cards', 'elemental'];

  public function char() {
    return $this->belongsTo('App\Char', 'char_id');
  }

  public function vending_item() {
    return $this->hasOne('App\Vending', 'cartinventory_id');
  }

  function getStrongAttribute() {
    if($this->card0 != 255 && $this->card0 != 254) return 0;
    $strong = 0;
    if($this->card1 == 3840) {
      $strong = 3;
    } else if($this->card1 >= 2560 && $this->card1 <= 2564) {
      $strong = 2;
    } else if($this->card1 >= 1280 && $this->card1 <= 1284) {
      $strong = 1;
    }
    return $strong;
  }

  function getCardsAttribute() {
    if($this->card0 == 255 || $this->card0 == 254) return [];
    $cards = [];

    if(!empty($this->card0)) array_push($cards, $this->card0);
    if(!empty($this->card1)) array_push($cards, $this->card1);
    if(!empty($this->card2)) array_push($cards, $this->card2);
    if(!empty($this->card3)) array_push($cards, $this->card3);
    
    return $cards;
  }

  function getElementalAttribute() {
    if($this->card0 != 255 && $this->card0 != 254) return '';
    
    $el = '';
    $elements = [
      'water' => [1, 1281, 2561],
      'earth' => [2, 1282, 2562],
      'fire' => [3, 1283, 2563],
      'wind' => [4, 1284, 2564],
    ];

    foreach($elements as $element => $values) {
      if(in_array($this->card1, $values)) $el = $element;
    }

    return $el;
  }

}
