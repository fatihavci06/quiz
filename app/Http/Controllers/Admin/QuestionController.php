<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Http\Requests\QuestionCreateRequest;
use Illuminate\Support\Str;
use App\Http\Requests\QuestionUpdateRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {

       $data['quiz']= Quiz::find($id);
      $data['questions']= Quiz::findOrFail($id)->questions;
       if($request->get('questions')){
          $data['questions']=$data['questions']->where('questions','LIKE','%'.$request->get('questions').'%');
         
       }
        
        
        return view('admin.question.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       $quiz= Quiz::findOrFail($id);
       return view('admin.question.create',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request,$id)
    {

        if($request->hasfile('image')){
            $imagename=Str::slug($request->questions).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imagename);
            $request->merge(['image'=>'/uploads/'.$imagename]);


         }
        Quiz::find($id)->questions()->create($request->post()); // question quiz modelinde tanımlanmış bir hasmany relationudur. gelen tüm post datasını kolaylıkla database relation üzerinden kaydedebiliriz.formun inputlarını sütün isimleriyle yazdığımız için posttan gelen datayı olduğu gibi dbye yazdık.

        return redirect()->route('questions.index',$id)->withSuccess('Soru Başarıyla Oluşturuldu');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quiz_id,$id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id,$question_id)
    {
        $question=Quiz::findOrFail($quiz_id)->questions->where('id',$question_id)->first();

        return view('admin.question.update',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id,$question_id)
    {
        if($request->hasfile('image')){
            $imagename=Str::slug($request->questions).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imagename);
            $request->merge(['image'=>'/uploads/'.$imagename]);


         }
        Quiz::find($quiz_id)->questions()->where('id',$question_id)->first()->update($request->post()); // question quiz modelinde tanımlanmış bir hasmany relationudur. gelen tüm post datasını kolaylıkla database relation üzerinden kaydedebiliriz.formun inputlarını sütün isimleriyle yazdığımız için posttan gelen datayı olduğu gibi dbye yazdık.Bize gelen quiz idye göre ilgili quizi bulduk.Daha sonra quize ait soruları bulduk.Daha sonra o sorulardan bize gelen question_id ye göre filtreledik ve update ettik
        

        return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id,$question_id)
    {
        Quiz::find($quiz_id)->questions()->where('id',$question_id)->delete();
       return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Silindi ');
    }
}
