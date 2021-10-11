<x-app-layout>
	<x-slot name="header">
        Quiz Güncelle
    </x-slot>
     <x-slot name="message2">
     	
     	
    	<div class="card-body">
    		<form method="POST" action="{{route('quizzes.update',$quiz->id)}}">
    			@csrf
    			@method('PUT')
    			<div class="form-group">
    				<label>Quiz Güncelle</label>
    				<input type="text" name="title" class="form-control" value="{{$quiz->title}}" required>
    			</div>
    			<div class="form-group">
    				<label>Quiz Açıklama</label>
    				<textarea name="descryption"  class="form-control" rows="4">{{$quiz->descryption}}</textarea> 
    			</div>
    			<div class="form-group">
    				<label>Durum</label>
    				<select name="status" class="form-control">
    					<option @if($quiz->status=='publish') selected @endif @if($quiz->questions_count<1) disabled @endif value="publish">Aktif</option>
    					<option @if($quiz->status=='draft') selected @endif value="draft">Taslak</option>
    					<option @if($quiz->status=='passive') selected @endif value="passive">Pasif</option>
    				</select> 
    			</div>
    			<div class="form-group">
    				<input id="isFinished"  @if($quiz->finished_at) checked @endif  type="checkbox">
    				<label>Bitiş Tarihi Olacak mı?</label>

    			</div>
    			<div  @if(!$quiz->finished_at) style="display:none;" @endif  id="finishInput" class="form-group">
    				<label>Quiz Bitiş Tarihi</label>
    				<input type="datetime-local" id="finishsifirla" name="finished_at" @if($quiz->finished_at) value="{{date('Y-m-d\TH:i',strtotime($quiz->finished_at))}}" @endif class="form-control">
    			</div><br/>
    			<div class="form-group">
    				<button type="submit" class="form-control btn btn-success btn-sm btn-block">Güncelle</button>
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
					$('#finishsifirla').val('');
					
				}
			})
		</script>
	</x-slot>
</x-app-layout>