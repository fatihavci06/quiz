<x-app-layout>
    <x-slot name="header">
        {{$quiz_detay->title}}
    </x-slot>

     <x-slot name="message2">
       <div class="card">
          <div class="card-body">
            <p class="card-text">
                <form method="post" action="{{route('quiz.result',$quiz_detay->slug)}}"> 
                    @csrf
                @foreach($quiz_detay->questions as $question)
               <strong>{{$loop->iteration}}){{$question->questions}}</strong>

               @if($question->image)
               <img src="{{asset($question->image)}}" style="width:50%;" class="img-responsive" />
               @endif
                    <div class="form-check mt-2" >
                      <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}1" value="answer1" required>
                      <label class="form-check-label" for="quiz{{$question->id}}1">
                       {{$question->answer1}}
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}2" value="answer2" required>
                      <label class="form-check-label" for="quiz{{$question->id}}2">
                       {{$question->answer2}}
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}3" value="answer3" required>
                      <label class="form-check-label" for="quiz{{$question->id}}3" required>
                       {{$question->answer3}}
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="{{$question->id}}" id="quiz{{$question->id}}4" value="answer4" >
                      <label class="form-check-label" for="quiz{{$question->id}}4">
                       {{$question->answer4}}
                      </label>
                    </div>
                    
                        <hr/>
                    
                    
                @endforeach
                <button class="btn btn-success btn-sm btn-block" type="submit">Bitir</button>
            </form>

            </p>
            
          
            
            
          </div>
        </div>
        
    </x-slot>
</x-app-layout>
