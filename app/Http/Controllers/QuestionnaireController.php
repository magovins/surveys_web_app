<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionnaire;
use App\Question;

class QuestionnaireController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function create()
	{
		return view('questionnaire.create');
	}

	public function store()
	{
		$data = request()->validate([
			'title' => 'required|max:100',
			'purpose' => 'required|max:255'
		]);
		
		//$data['user_id'] = auth()->user()->id; 
		//$questionnaire = Questionnaire::create($data);

		$questionnaire = auth()->user()->questionnaires()->create($data);
		return redirect('/questionnaires/'.$questionnaire->id);
	}

	public function show(Questionnaire $questionnaire)
	{
		$questionnaire->load('questions.answers.responses');
		//dd($questionnaire);
		return view('questionnaire.show', compact('questionnaire'));
	}

	public function destroy(Questionnaire $questionnaire, Question $questions)
    {
    	//dd($questionnaire->questions);
    	foreach ($questionnaire->questions as $question) {
    		foreach($question->answers as $answer){
    			$answer->delete();
    		}
    		$question->delete();
    	}
       	$questionnaire->delete();
        return redirect('home');
    }

    public function search()
    {
    	return view('questionnaire.search');
    }
}
