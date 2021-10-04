<x-app-layout>
    <x-slot name="header">
        {{$quiz_detay->title}}
    </x-slot>

     <x-slot name="message2">
       
          <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
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
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Katılımcı Sayısı
                        <span >14</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Ortalama Puan
                        <span >2</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Morbi leo risus
                        <span class="badge badge-primary badge-pill">1</span>
                      </li>
                    </ul>
                </div>
                <div class="col-md-8">
                      <p class="card-text"> {{$quiz_detay->descryption}}</p>
                      <a href="{{route('quiz.join',$quiz_detay->slug)}}" class="btn btn-primary btn-block btn-sm">Quize Katıl</a>
                </div>
            </div>
            
          
            
            
          </div>
        
    </x-slot>
</x-app-layout>
