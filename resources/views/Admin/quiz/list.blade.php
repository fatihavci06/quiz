<x-app-layout>
    <x-slot name="header">
        Quizler
    </x-slot>

     <x-slot name="message2">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title " style="float: right;"><a href="{{route('quizzes.create')}}" class="btn btn-success"><i class="fa fa-plus"></i>Quiz Oluştur</a></h5>
                <form method="GET" action="{{route('quizzes.index')}}">
                  <div class="row">
                    
                    <div class="col-md-4">
                      <input type="text" value="{{ request()->get('title')}}" name="title" placeholder="Quiz adı" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <select class="form-control" onchange="this.form.submit()" name="status">
                          <option  value="">Durum seçiniz</option>
                          <option @if(request()->get('status')=="publish") selected @endif value="publish">Aktif</option>
                          <option @if(request()->get('status')=="passive") selected @endif value="passive">Pasif</option>
                          <option @if(request()->get('status')=="draft") selected @endif value="draft">Taslak</option>
                      </select>
                    </div>
                    @if(request()->get('title') || request()->get('status') )
                    <div class="col-md-2">
                      <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Sıfırla</a>
                    </div>
                    @endif
                  </div>
                </form>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Quiz</th>
                      <th scope="col">Soru Sayısı</th>
                      <th scope="col">Durum</th>
                      <th scope="col">Bitiş Tarihi</th>
                      <th scope="col">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($quizzes as $q )
                    <tr>
                      <th >{{$q->title}}</th>
                      <th >{{$q->questions_count}}</th>
                      <td>
                          @switch($q->status)
                              @case('publish')
                                <span >Aktif</span>
                              @break
                              @case('passive')
                                <span >Pasif</span>
                              @break
                              @case('draft')
                                <span >Taslak</span>
                              @break
                           @endswitch



                      </td>
                      <td><span title="{{$q->finished_at}}">{{ \Carbon\Carbon::parse($q->finished_at)->diffForHumans() }}</span>

</td>
                      <td>
                        <a href="{{route('questions.index',$q->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-question"></i></a>
                        <a href="{{route('quizzes.edit',$q->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="{{route('quizzes.sil',$q->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

                      </td>
                    </tr>
                    @endforeach
                    
                  </tbody>

                </table>
                 {{ $quizzes->withQueryString()->links() }}
            </div>
        </div>
        <!-- layout/app.blade.php deki message2 isimli slot içerisine gönderilir -->
    </x-slot>
</x-app-layout>
