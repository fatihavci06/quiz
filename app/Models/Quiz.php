<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['title','descryption','finished_at'];

     protected $dates = [
          'finished_at'
      ];


    public function questions(){
      return  $this->hasMany(Question::class, 'quiz_id', 'id');  //post tablosundaki user benim(user tablosu) idime eşit demek
    }

    
}
