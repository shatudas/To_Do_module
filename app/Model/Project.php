<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Project extends Model
{
    public function teamlider(){
   	return $this->belongsTo(User::class,'project_manager','id');
   }

    public function teamMember(){
    return $this->belongsTo(User::class,'team','id');
   }

  
}
