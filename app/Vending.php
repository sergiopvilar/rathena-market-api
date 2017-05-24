<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Vending extends Model {
  protected $table = 'vendings';

  protected $hidden = [
    'body_direction',
    'head_direction',
    'sit',
    'sex',
    'char_id',
    'id',
    'account_id',
  ];

  public function build() {
    $char = Char::find($this->char_id);
    return (object) [
        'char' => (object) [
          'name' => $char->name,
          'class' => $char->class,
          'base_level' => $char->base_level,
          'job_level' => $char->job_level,
         ],
        'map' => $this->map,
        'x' => $this->x,
        'y' => $this->y,
        'title' => $this->title,
        'autotrade' => ($this->autotrade == 1),
        'items' => VendingItem::get_all('vending_id', $this->id)
      ];
  }

  public static function retrieve($vendings) {
    $return_objects = [];
    foreach($vendings as $vend)
      array_push($return_objects, $vend->build());
    return $return_objects;
  }

  public static function get_all() {
    return Vending::retrieve(Vending::all());
  }

  public static function from($char_name) {
    $char_id = Char::where('name', $char_name)->first()->char_id;
    return Vending::where('char_id', $char_id)->first()->build();
  }

}
