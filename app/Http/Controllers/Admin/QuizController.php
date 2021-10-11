<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;
use Illuminate\Support\Str;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['quizzes']=Quiz::withCount('questions');
        if($request->get('title')){
          $data['quizzes']=$data['quizzes']->where('title','LIKE','%'.$request->get('title').'%');
        }
        if($request->get('status')){
            $data['quizzes']=$data['quizzes']->where('status','LIKE','%'.$request->get('status').'%');
        }
         $data['quizzes']=$data['quizzes']->paginate(5);

       return view('admin.quiz.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizCreateRequest $request)
    {
        $quiz= new Quiz;
        $quiz->title=$request->title;
        $quiz->descryption=$request->descryption;
        $quiz->slug=Str::slug($request->title);
        $quiz->finished_at=$request->finished_at;
        $quiz->status='draft';
        $quiz->save();


        return redirect()->route('quizzes.index')->withSuccess('Quiz Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $quiz_detay=Quiz::withCount('results')->withAvg('results','point')->withCount('questions')->with('top10')->with('results.uyebilgisi')->where('id',$id)->first();
        return view('Admin.quiz.quiz_detail',compact('quiz_detay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $quiz=Quiz::withCount('questions')->findOrFail($id);
       
        return view('Admin.quiz.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizUpdateRequest $request, $id)
    {
       $request->finished_at;
        $quiz=Quiz::findOrFail($id);
        $quiz->title=$request->title;
        $quiz->descryption=$request->descryption;
        $quiz->slug=Str::slug($request->title);
       $quiz->finished_at=$request->finished_at;
        

      
       
        $quiz->status=$request->status;
        $quiz->save();

        return redirect()->route('quizzes.index')->withSuccess('Quiz Güncelleme İşlemi Başarılı!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz=Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quizzes.index')->withSuccess('Quiz Silme İşlemi Başarılı!');
    }
}
