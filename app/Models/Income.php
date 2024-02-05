<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model{
    use HasFactory;
 
    protected $praimeryKey="income_id";

    public function categoryInfo(){
        return $this->belongsTo('App\Models\IncomeCategory','incate_id','incate_id');
    }
    
    public function creatorInfo(){
        return $this->belongsTo('App\Models\User','income_creator','id');
    }

    public function editorInfo(){
        return $this->belongsTo('App\Models\User','income_editor','id');
    }

}
