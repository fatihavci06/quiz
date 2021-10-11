<x-app-layout>
    <x-slot name="header">
        {{$quiz_detay->title}}
    </x-slot>

     <x-slot name="message2">
       <div class="card">
          <div class="card-body">
            Puanım:{{$quiz_detay->my_result->point}}
            <div class="alert bg-light">
                <i class="fa fa-check text-success"></i> Doğru Cevap
                 <i class="fa fa-times text-danger"></i> Yanlış Cevap
                  <i class="fa fa-square "></i> İşaretlediğin şık
            </div>
            <p class="card-text">

                
                @foreach($quiz_detay->questions as $question)

                 Bu soruyu %{{$question->dogru_cevaplayan}} kişi doğru cevapladı.<br/>
                @if($question->correct_answer==$question->my_answer->answer)
                 <i class="fa fa-check text-success"></i>
                @else
                <i class="fa fa-times text-danger"></i>
                @endif

               <strong>{{$loop->iteration}}){{$question->questions}}</strong>

               @if($question->image)
               <img src="{{asset($question->image)}}" style="width:50%;" class="img-responsive" />
               @endif
                    <div class="form-check mt-2" >
                     @if($question->correct_answer=='answer1')
                     <i class="fa fa-check text-success"></i>
                     @elseif($question->my_answer->answer=='answer1')
                      <i class="fa fa-square "></i>
                     @endif
                      <label class="form-check-label" for="quiz{{$question->id}}1">
                       {{$question->answer1}}
                      </label>
                     
                    </div>
                    <div class="form-check">
                    @if($question->correct_answer=='answer2')
                    <i class="fa fa-check text-success"></i>
                    @elseif($question->my_answer->answer=='answer2')
                      <i class="fa fa-square "></i>
                    @endif
                      <label class="form-check-label" for="quiz{{$question->id}}2">
                       {{$question->answer2}}
                      </label>
                   
                    </div>
                    <div class="form-check">
                      @if($question->correct_answer=='answer3')
                      <i class="fa fa-check text-success"></i>
                      @elseif($question->my_answer->answer=='answer3')
                      <i class="fa fa-square "></i>
                      @endif

                      <label class="form-check-label" for="quiz{{$question->id}}3" required>
                       {{$question->answer3}}
                      </label>
                      
                    </div>
                    <div class="form-check">
                       @if($question->correct_answer=='answer4')
                       <i class="fa fa-check text-success"></i>
                       @elseif($question->my_answer->answer=='answer4')
                      <i class="fa fa-square "></i>
                       @endif
                      <label class="form-check-label" for="quiz{{$question->id}}4">
                       {{$question->answer4}}
                      </label>

                    </div>
                    
                        <hr/>
                    
                    
                @endforeach
                

            </p>
            
          
            
            
          </div>
        </div>
        
    </x-slot>
</x-app-layout>
