@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $questionnaire->title }}</div>

                <div class="card-body">
                    {{ $questionnaire->purpose }}
                    <div>
                        <a href="/questionnaires/{{ $questionnaire->id }}/questions/create" class="btn btn-dark">Add new question</a>
                        <a href="/surveys/{{ $questionnaire->id }}" class="btn btn-dark">Take Survey</a>
                    </div>
                </div>
                
                @foreach($questionnaire->questions as $question)
                <div class="card mt-4">
                    <div class="card-header">{{ $question->question }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($question->answers as $answer)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>{{ $answer->answer }}</div>
                                @if($question->responses->count())
                                    <div>{{ intval(($answer->responses->count()*100) / $question->responses->count()) }}%</div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-footer" style="display: inline;">
                        <form action="/questionnaires/{{ $questionnaire->id }}/questions/{{ $question->id }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-outline-danger">Delete question</button>
                        </form>

                        <form action="/questionnaires/{{ $questionnaire->id }}/questions/{{ $question->id }}/edit" method="post">
                              @csrf
                              <button type="submit" class="btn btn-sm btn-outline-primary mt-2">Edit question</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
