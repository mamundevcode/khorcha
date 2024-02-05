<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model{
 use HasFactory;

 protected $praimeryKey="expense_id";

    public function categoryInfo(){
        return $this->belongsTo('App\Models\ExpenseCategory','expcate_id','expcate_id');
    }
    
    public function creatorInfo(){
        return $this->belongsTo('App\Models\User','expense_creator','id');
    }

    public function editorInfo(){
        return $this->belongsTo('App\Models\User','expense_editor','id');
    }

}
