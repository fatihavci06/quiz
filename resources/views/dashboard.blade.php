<x-app-layout>
    <x-slot name="header">
        Anasayfa
    </x-slot>

     <x-slot name="message2">
        <div class="row">
            <div class="col-md-8">
                
                <div class="list-group">
                    @foreach($quizzes as $quiz)
                      <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start ">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">{{$quiz->title}}</h5>
                          <small>
                              
                                @if($quiz->finished_at)
                                {{ \Carbon\Carbon::parse($quiz->finished_at)->diffForHumans() }}
                                @endif

                          </small>
                        </div>
                        <p class="mb-1">{{$quiz->descryption}}</p>
                        <small>{{$quiz->questions_count}}</small>
                      </a>
                      @endforeach
                      {{$quizzes->links()}}
                    </div>

            </div>
            <div class="col-md-4">
                
                    <div class="card mt-2" style="width: 18rem;">
                          <div class="card-header">
                            Sonuçlarım
                          </div>
                          <ul class="list-group list-group-flush">
                             @foreach($sonuclar as $s)
                            <li class="list-group-item">{{$s->point}}-<a href="{{route('quiz.detail',$s->quiz->slug)}}">{{$s->quiz->title}}</a></li>
                            @endforeach
                            
                          </ul>
                        </div>
                
                
            </div>

        </div>
    </x-slot>
</x-app-layout>
