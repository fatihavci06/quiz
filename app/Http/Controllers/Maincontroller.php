<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\answer;
class Maincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
       $quizzes=Quiz::where('status','publish')->withCount('questions')->paginate(5);//quiz modelinden statusu publish olanları çek ve ek olarak ilişkili questionsların sayını çekerek paginate et.questions quiz tablosunda tanımlı bir ilişkidir
        return view('dashboard',compact('quizzes'));   

         }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz_detail($slug)
    {
        $quiz_detay=Quiz::where('slug',$slug)->withCount('questions')->first() ?? abort(404,'not found');
        return view('quiz_detail',compact('quiz_detay'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quiz($slug)
    {
        $quiz_detay=Quiz::where('slug',$slug)->with('questions')->first();
        return view('quiz',compact('quiz_detay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function result(Request $request, $slug)
    {
        
        $quiz=Quiz::where('slug',$slug)->with('questions')->first() ?? abort(404,'Quiz bulunamadı');
       foreach($quiz->questions as $question){
            echo 'dogru cevap:'.$question->correct_answer.'-verilen cevap:'.$request->post($question->id).'<br/>';
             answer::create([
                'user_id'=>auth()->user()->id,
                'question_id'=>$question->id,
                'answer'=>$request->post($question->id)

             ]);
       }


       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
