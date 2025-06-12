<?php

namespace App\Http\Controllers;

use App\Classes\MyAI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealSuggestionController extends Controller
{
    public function index()
    {
        $suggestions = Auth::user()->meal_suggestions;
        return view('meal-suggestion', compact('suggestions'));
    }
}
