<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        // dd($search);
        $questions = Question::where('title', 'like', '%' . $search . '%')->paginate(8);
        return view('search', compact('questions'));
    }
}
