<x-app-layout>
	<x-slot name="header">
        Quiz Oluştur
    </x-slot>
     <x-slot name="message2">
     	
     	
    	<div class="card-body">
    		<form method="POST" action="{{route('quizzes.store')}}">
    			@csrf

    			<div class="form-group">
    				<label>Quiz Başlığı</label>
    				<input type="text" name="title" class="form-control" value="{{old('title')}}" required>
    			</div>
    			<div class="form-group">
    				<label>Quiz Açıklama</label>
    				<textarea name="descryption"  class="form-control" rows="4">{{old('descryption')}}</textarea> 
    			</div>
    			<div class="form-group">
    				<input id="isFinished" type="checkbox" @if(old('finished_at')) checked @endif>
    				<label>Bitiş Tarihi Olacak mı?</label>

    			</div>
    			<div  @if(!old('finished_at')) style="display:none;" @endif id="finishInput" class="form-group">
    				<label>Quiz Bitiş Tarihi</label>
    				<input type="datetime-local" name="finished_at" value="{{old('finished_at')}}" class="form-control">
    			</div><br/>
    			<div class="form-group">
    				<button type="submit" class="form-control btn btn-success btn-sm btn-block">Oluştur</button>
    			</div>
    		</form>
    	</div>
	</x-slot>
	<x-slot name="js">
		<script>
			$('#isFinished').change(function(){
				if($('#isFinished').is(':checked')){
					$('#finishInput').show();
				}
				else{
					$('#finishInput').hide();
				}
			})
		</script>
	</x-slot>
</x-app-layout>