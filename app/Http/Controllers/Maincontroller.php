<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\answer;
use App\Models\result;
class Maincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
       $data['quizzes']=Quiz::where('status','publish')->where(function($query){
            $query->whereNull('finished_at')->orWhere('finished_at','>',now());
        })->withCount('questions')->paginate(5);//quiz modelinden statusu publish olanları çek ve ek olarak ilişkili questionsların sayını çekerek paginate et.questions quiz tablosunda tanımlı bir ilişkidir
       // $data['sonuclar']=Quiz::with('my_result')->limit(5)->get();
       $data['sonuclar']=result::where('user_id',auth()->user()->id)->with('quiz')->orderByDesc('point')->
      limit(10)->get();

        return view('dashboard',$data);   

         }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quiz_detail($slug)
    {
       
     

    $data['quiz_detay']=Quiz::where('slug',$slug)->with('my_result')->withCount('results')->withAvg('results','point')->with('results')->withCount('questions')->first() ?? abort(404,'not found');
        $quiz_id=$data['quiz_detay']->id;
       $data['top10']=result::where('quiz_id',$quiz_id)->with('uyebilgisi')->orderByDesc('point')->limit(10)->get();
      $data['ben']=result::where('quiz_id',$quiz_id)->orderByDesc('point')->get();
   $data['puanim']=result::where('quiz_id',$quiz_id)->where('user_id',auth()->user()->id)->first();
        $sira=0;
        foreach($data['ben'] as $d){
            $sira=$sira+1;
            if(auth()->user()->id==$d->user_id){
                $data['siram']=$sira;
                
            }
        }
       
       
        return view('quiz_detail',$data);
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
        $quiz_detay=Quiz::where('slug',$slug)->with('questions.my_answer')->with('my_result')->with('questions.cevaplar')->first() ?? abort(404,'bulunamadı');
        if($quiz_detay->my_result){

            $katilimci_sayisi=count($quiz_detay->questions[0]->cevaplar);
            
            
            return view('quizresult',compact('quiz_detay'));
        }
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
        
         $quiz=Quiz::where('slug',$slug)->with('questions')->withCount('questions')->first() ?? abort(404,'Quiz bulunamadı');
        $correct=0;
       foreach($quiz->questions as $question){
          
             answer::create([
                'user_id'=>auth()->user()->id,
                'question_id'=>$question->id,
                'answer'=>$request->post($question->id)

             ]);
             
             if($question->correct_answer===$request->post($question->id)){
                $correct=$correct+1;
             }

       }
        $point=100/$quiz->questions_count*$correct; //yukarıdaki ilişkisel sorugda withCount ile çekildi
        $point=round($point);
        $wrong= $quiz->questions_count-$correct;

       result::create([
                'user_id'=>auth()->user()->id,
                'quiz_id'=>$quiz->id,
                'point'=>$point,
                'correct'=>$correct,
                'wrong'=>$wrong

             ]);

       return redirect()->route('quiz.detail',$quiz->slug)->withSuccess('Başarıyla quizi bitirdin puanın :'.$point);
       
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
