<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\answer;
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
    public function my_result(){
      return  $this->hasOne(result::class, 'quiz_id', 'id')->where('user_id',auth()->user()->id);  
    }


    
    public function results(){
      return  $this->hasMany(result::class, 'quiz_id', 'id');  //post tablosundaki user benim(user tablosu) idime eşit demek
    }
    public function top10(){
      return  $this->hasMany(result::class, 'quiz_id', 'id')->orderByDesc('point')->limit(10);  //post tablosundaki user benim(user tablosu) idime eşit demek
    }
    
    

    
}
