<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model{
 use HasFactory;

 protected $praimeryKey="expcate_id";

 public function creatorinfo(){
     return $this->belongsTo('App\Models\User','expcate_creator','id');
 }
 public function editorinfo(){
     return $this->belongsTo('App\Models\User','expcate_editor','id'); 
 }
}
