<x-app-layout>
    <x-slot name="header">
        {{$quiz_detay->title}}
    </x-slot>

     <x-slot name="message2">
       
          <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        @if($quiz_detay->my_result)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           Puan
                            <span title="{{$quiz_detay->finished_at}}">
                             {{ $quiz_detay->my_result->point }}
                         </span>
                          </li>
                          @endif
                            @if($quiz_detay->my_result)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                           Doğru/Yanlış Sayısı
                            <span title="{{$quiz_detay->finished_at}}" >
                             {{ $quiz_detay->my_result->correct }} Doğru /{{ $quiz_detay->my_result->wrong }} Yanlış
                         </span>
                          </li>
                          @endif

                        @if($quiz_detay->finished_at)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           Tamamlanma Tarihi
                            <span title="{{$quiz_detay->finished_at}}"> {{ \Carbon\Carbon::parse($quiz_detay->finished_at)->diffForHumans() }}</span>
                          </li>
                          @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                       Soru Sayısı
                        <span >{{$quiz_detay->questions_count}}</span>
                      </li>
                      @if($quiz_detay->results_count)
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Katılımcı Sayısı
                        <span >{{$quiz_detay->results_count}}</span>
                      </li>
                      @endif
                       @if($quiz_detay->results_avg_point)
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ortalama Puan
                        <span >{{@round($quiz_detay->results_avg_point)}}</span>
                      </li>
                      @endif
                      
                    </ul>
                    @if($top10)
                    <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="card-title">İlk 10</h5>
                            <ul class="list-group">
                                @foreach($top10 as $t)
                                <li class="list-group-item" @if(auth()->user()->id==$t->user_id) style="color:#3ed;" @endif>
                                    {{$loop->iteration}}-
                                    {{$t->uyebilgisi->name}}
                                    <span>{{$t->point}}</span>
                                   
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    @isset($siram)
                    @if($siram>10)
                    <li class="list-group-item">
                                    {{$siram}}
                                    {{auth()->user()->name}}
                                    <span>{{$puanim->point}}</span>
                                   
                      </li>
                    @endif
                    @endisset
                </div>
                <div class="col-md-8">
                      <p class="card-text"> {{$quiz_detay->descryption}}</p>
                    
                    

                    
                    @if($quiz_detay->my_result )
                    <a href="{{route('quiz.join',$quiz_detay->slug)}}" class="btn btn-primary btn-block btn-sm">Quizi Görüntüle </a>
                    @elseif($quiz_detay->finished_at>now())
                      <a href="{{route('quiz.join',$quiz_detay->slug)}}" class="btn btn-primary btn-block btn-sm">Quize Katıl</a>
                    @endif
                   
                </div>
            </div>
            
          
            
            
          </div>
        
    </x-slot>
</x-app-layout>
