@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Question</div>

                <div class="card-body">
                    <form action="/questionnaires/{{ $questionnaire->id }}/questions/{{ $question->id }}" method="POST" accept-charset="utf-8">
                        
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group">
                            
                            <label for="question">
                                <legend class="mb-0">Question</legend>
                            </label>
                            <small id="titleHelp" class="form-text text-muted mt-0">Ask simple and to-the-point questions for best results.</small>
                            <input name="question[question]" type="text" class="form-control" id="question" aria-describedby="question-help" placeholder="Enter question" value="{{$question->question }}">
                            
                            @error('question.question')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <fieldset>
                                
                                <legend class="mb-0">Choices</legend>
                                <small id="choicesHelp" class="form-text text-muted">Give choices.</small>

                                <div>
                                    <div class="form-group mt-4">
                                        <label for="answer1">Choice 1</label>
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer1" aria-describedby="choicesHelp" placeholder="Enter answer1" value="{{ (old('answers.0.answer')) ? 'answers.0.answer':$question->answers[0]->answer }}">
                                        
                                        @error('answers.0.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group">
                                        <label for="answer2">Choice 2</label>
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer2" aria-describedby="choicesHelp" placeholder="Enter answer2" value="{{ (old('answers.1.answer')) ? 'answers.1.answer':$question->answers[1]->answer }}">
                                        
                                        @error('answers.1.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group">
                                        <label for="answer3">Choice 3</label>
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer3" aria-describedby="choicesHelp" placeholder="Enter answer3" value="{{ (old('answers.2.answer')) ? 'answers.2.answer':$question->answers[2]->answer }}">
                                       
                                        @error('answers.2.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group">
                                        <label for="answer4">Choice 4</label>
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer4" aria-describedby="choicesHelp" placeholder="Enter answer4" value="{{(old('answers.3.answer')) ? 'answers.3.answer':$question->answers[3]->answer}}">
                                        
                                        @error('answers.3.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                            </fieldset>
                        </div>

                        <button type="submit" class="btn btn-primary">Save question</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
