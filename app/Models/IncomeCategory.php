<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model{
    use HasFactory;

    protected $praimeryKey="incate_id";

    public function creatorinfo(){
        return $this->belongsTo('App\Models\User','incate_creator','id');
    }
    public function editorinfo(){
        return $this->belongsTo('App\Models\User','incate_editor','id');
    }
   
}
