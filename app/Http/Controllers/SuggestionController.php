<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function meal()
    {
        $suggestions = Auth::user()->meal_suggestions;
        return view('meal-suggestion', compact('suggestions'));
    }

    public function exercise()
    {
        $suggestions = Auth::user()->exercise_suggestions;
        return view('exercise-suggestion', compact('suggestions'));
    }
}
