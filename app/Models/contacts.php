<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'nombre', 'telefono', 'email'])]

class contacts extends Model
{
  use HasFactory;

  public function user(){
    return $this->belongsTo(user::class);
  }
}