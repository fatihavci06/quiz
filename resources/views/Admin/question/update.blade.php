<x-app-layout>
	<x-slot name="header">
        {{$question->questions}}  düzenle
    </x-slot>
     <x-slot name="message2">
     	
     	
    	<div class="card-body">
    		<form method="POST" action="{{route('questions.update',[$question->quiz_id,$question->id])}}" enctype="multipart/form-data">
    			@csrf
    			@method('PUT') <!-- resource controller için bunu ekledik -->
    			<div class="form-group">
    			    <label>Soru</label>
    				<textarea name="questions"  class="form-control" rows="4">{{$question->questions}}</textarea>
    			</div>
    			@if($question->image)
    			<div class="form-group">
    				<img src="{{asset($question->image)}}" style="width:100px;height:100px ;">
    				
    			</div>
    			@endif
    			<div class="form-group">
    				<label>Fotoğraf</label>
    				<input type="file" name="image" class="form-control"> 
    			</div>
    			<div class="row">
    				<div class="col-md-6">
    					<div class="form-group">
		    			    <label>1. Cevap</label>
		    				<textarea name="answer1"  class="form-control" rows="2">{{$question->answer1}}</textarea>
		    			</div>
    				</div>
    				<div class="col-md-6">
    					<div class="form-group">
		    			    <label>2. Cevap</label>
		    				<textarea name="answer2"  class="form-control" rows="2">{{$question->answer2}}</textarea>
		    			</div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-md-6">
    					<div class="form-group">
		    			    <label>3. Cevap</label>
		    				<textarea name="answer3"  class="form-control" rows="2">{{$question->answer3}}</textarea>
		    			</div>
    				</div>
    				<div class="col-md-6">
    					<div class="form-group">
		    			    <label>4. Cevap</label>
		    				<textarea name="answer4"  class="form-control" rows="2">{{$question->answer4}}</textarea>
		    			</div>
    				</div>
    			</div>

    			<div class="form-group">
    				
    				<label>Doğru Cevap</label>
    				<select name="correct_answer" class="form-control">
    					<option @if($question->correct_answer=='answer1') selected @endif value="answer1">1.Cevap</option>
    					<option @if($question->correct_answer=='answer2') selected @endif value="answer2">2.Cevap</option>
    					<option @if($question->correct_answer=='answer3') selected @endif value="answer3">3.Cevap</option>
    					<option @if($question->correct_answer=='answer4') selected @endif value="answer4">4.Cevap</option>
    				</select>

    			</div>
    			
    			<div class="form-group mt-2">
    				<button type="submit" class="form-control btn btn-success btn-sm btn-block">Soru Güncelle</button>
    			</div>
    		</form>
    	</div>
	</x-slot>
	
</x-app-layout>