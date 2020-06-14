<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Questionnaire;
use App\Answer;

class QuestionController extends Controller
{
    public function create(Questionnaire $questionnaire)
    {
    	return view('question.create', compact('questionnaire'));
    }

    public function store(Questionnaire $questionnaire)
    {
    	//dd(request()->all());
    	$data = request()->validate([
    		'question.question' => 'required',
    		'answers.*.answer' => 'required'
    	]);
    	//dd($data)
    	$question = $questionnaire->questions()->create($data['question']);
    	$question->answers()->createMany($data['answers']);

    	return redirect('questionnaires/'.$questionnaire->id);
    }

    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        $question->answers()->delete();

        $question->delete();

        return redirect($questionnaire->path());
    }

    public function edit(Questionnaire $questionnaire, Question $question)
    {
        //dd($questionnaire,$question,$question->answers);
        
        //passo alla view.edit solo i dati ma la modifica vera e propria avviene
        //dalla pagina edit tramite il metodo PATCH
        return view('question.edit', compact('questionnaire','question'));
    }

    public function update(Questionnaire $questionnaire, Question $question)
    {
        $data = request()->validate([
            'question.question' => 'required',
            'answers.*.answer' => 'required'
        ]);
        $retrieveAnswers = Answer::where('question_id',$question->id)->get();

        foreach ($retrieveAnswers as $key => $answer) {
            $answer->update($data['answers'][$key]); 
        }

        $question->update($data['question']);
        
        return redirect($questionnaire->path());
    }
}
