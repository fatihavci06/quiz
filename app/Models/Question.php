<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\answer;
class Question extends Model
{
    protected $fillable = ['questions','answer1','answer2','answer3','answer4','correct_answer','image'];
    use HasFactory;

    protected $appends=['dogru_cevaplayan'];

    public function my_answer(){
      return  $this->hasOne(answer::class, 'question_id', 'id')->where('user_id',auth()->user()->id);  
    }
    public function cevaplar(){
      return  $this->hasMany(answer::class, 'question_id', 'id'); 
    }
    
    public function getDogruCevaplayanAttribute(){
       $cevap_sayisi=$this->cevaplar()->count();
       $dogru_cevaplar=$this->cevaplar()->where('answer',$this->correct_answer)->count();
       return  100/$cevap_sayisi*$dogru_cevaplar;
    }
   

}
