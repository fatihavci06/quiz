<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questions'=>'required|min:3',
            'image'=>'image|nullable|max:1024|mimes:jpg,jpeg,png',
            'answer1'=>'required|min:1',
            'answer2'=>'required|min:1',
            'answer3'=>'required|min:1',
            'answer4'=>'required|min:1',
            'correct_answer'=>'required'
        ];
    }
    public function attributes()  //burada error  mesajlarına Türkçe mesaj verilebilmesi için girdik Örneğin title gerekli yerine. Quiz açıklaması gerekli yazacak
    {
        return [
            'questions'=>'Soru',
            'image'=>'Resim',
            'answer1'=>'Cevap1',
            'answer2'=>'Cevap2',
            'answer3'=>'Cevap3',
            'answer4'=>'Cevap4',
            'correct_answer'=>'Doğru Cevap'
        ];
    }
}
