<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Char extends Model {
  protected $table = 'char';
  protected $primaryKey = 'char_id';

  protected $hidden = [
    "char_id", "account_id", "char_num", "base_exp", "job_exp", "zeny", "str", "agi", "vit", "int", "dex",
    "luk", "max_hp", "hp", "max_sp", "sp", "status_point", "skill_point", "option", "karma", "manner",
    "party_id", "guild_id", "pet_id", "homun_id", "elemental_id", "hair", "hair_color", "clothes_color",
    "body", "weapon", "shield", "head_top", "head_mid", "head_bottom", "robe", "last_map", "last_x",
    "last_y", "save_map", "save_x", "save_y", "partner_id", "online", "father", "mother", "child", "fame",
    "rename", "delete_date", "moves", "unban_time", "font", "uniqueitem_counter", "sex", "hotkey_rowshift",
    "clan_id", "last_login"
  ];

  public function vending() {
    return $this->hasOne('App\Vending', 'char_id');
  }

  public function buying() {
    return $this->hasOne('App\BuyingStore', 'char_id');
  }

  public function store() {

    $output = ['data' => []];

    if(!is_null($this->buying)) {
      $output = ['type' => 'buying', 'data' => $this->buying->load('char', 'items')];
    } else if(!is_null($this->vending)) {
      $output = ['type' => 'vending', 'data' => $this->vending->load('char', 'items', 'items.attributes')];
    }

    return (object) $output;
  }

}
