<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quiz;
class result extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','quiz_id','point','correct','wrong'];
    public function uyebilgisi(){
      return  $this->hasOne(User::class, 'id', 'user_id');  
    }
    
    public function quiz(){
      return  $this->hasOne(Quiz::class, 'id', 'quiz_id');  
    }

}
