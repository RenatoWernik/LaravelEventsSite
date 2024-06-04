<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $casts = [
        "items" => "array"
    ];
    protected $dates = ["date"];

    protected $guarded = [];


    public function user(){
        return $this->belongsTo("App\Models\User"); /*Estamos no model Event. Esse evento so possui um dono,então(belongsTo(one)user)*/

    }

    public function users(){
        return $this->belongsToMany("App\Models\User"); /*Estamos no model Event. Esse evento possui varios participantes(belongs to many users)*/

    }
}
