<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $questions = Question::where('title', 'like', '%' . $search . '%')->paginate(5);
        return view('search', compact('questions'));
    }
}
