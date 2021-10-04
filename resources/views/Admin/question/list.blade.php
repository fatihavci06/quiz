<x-app-layout>
    <x-slot name="header">
        '{{$quiz->title}}' quizine ait sorular
    </x-slot>

     <x-slot name="message2">
        <div class="card">
            <div class="card-body">

               <form method="GET" action="{{route('questions.index',$quiz->id)}}">
                  <div class="row">
                    
                    <div class="col-md-4">
                      <input type="text" value="{{ request()->get('questions')}}" name="questions" placeholder="Soru adı" class="form-control">
                    </div>
                    
                    @if(request()->get('title') || request()->get('status') )
                    <div class="col-md-2">
                      <a href="{{route('questions.index',$quiz->id)}}" class="btn btn-secondary">Sıfırla</a>
                    </div>
                    @endif
                  </div>
                </form>

               <div class="row"><div class="col-lg-10"><a href="{{route('quizzes.index')}}" class="btn btn-success"><i class="fa fa-plus"></i>Geri</a></div><div class="col-lg-2">
                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-success mr-0"><i class="fa fa-plus"></i>Soru Ekle</a></div>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Soru</th>
                      <th scope="col">Fotoğraf</th>
                      <th scope="col">1.Cevap</th>
                      <th scope="col">2.Cevap</th>
                      <th scope="col">3.Cevap</th>
                      <th scope="col">4.Cevap</th>
                      <th scope="col">Doğru Cevap</th>
                      <th scope="col" width="10%">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($questions as $qeustion )
                    <tr>
                      <td >{{$qeustion->questions}}</td>
                      <td >
                        @if($qeustion->image)
                        <a href="{{asset($qeustion->image)}}" target="_blank" />Görüntüle</a>
                        @endif
                        
                     </td>
                      <td >{{$qeustion->answer1}}</td>
                      <td >{{$qeustion->answer2}}</td>
                      <td >{{$qeustion->answer3}}</td>
                      <td >{{$qeustion->answer4}}</td>
                      <td class="text-success">{{substr($qeustion->correct_answer,-1)}}.Cevap</td>
                      <td>
                        <a href="" class="btn btn-sm btn-warning"><i class="fa fa-question"></i></a>
                        <a href="{{route('questions.edit',[$quiz->id,$qeustion->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="{{route('questions.sil',[$quiz->id,$qeustion->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>

                </table>
                
            </div>
        </div>
        <!-- layout/app.blade.php deki message2 isimli slot içerisine gönderilir -->
    </x-slot>
</x-app-layout>
