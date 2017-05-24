<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CartInventory extends Model {
  protected $table = 'cart_inventory';

  public function char() {
    return $this->belongsTo('App\Char');
  }

  function maker() {
    if($this->card0 != 255 && $this->card0 != 254) return '';
    return Char::where('char_id', $this->card2 + $this->card3)->first()->name;
  }

  function strong() {
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

  function cards() {
    if($this->card0 == 255 || $this->card0 == 254) return [];
    $cards = [];

    if(!empty($this->card0)) array_push($cards, $this->card0);
    if(!empty($this->card1)) array_push($cards, $this->card1);
    if(!empty($this->card2)) array_push($cards, $this->card2);
    if(!empty($this->card3)) array_push($cards, $this->card3);
    
    return $cards;
  }

  function elemental() {
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
