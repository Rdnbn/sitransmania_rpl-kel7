<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $role = auth()->user()->role;

        $result = [];

        if ($keyword) {
            $result = SearchService::search($keyword, $role);
        }

        return view('search.index', compact('result', 'keyword'));
    }
}
