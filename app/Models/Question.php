<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['questions','answer1','answer2','answer3','answer4','correct_answer','image'];
    use HasFactory;
}