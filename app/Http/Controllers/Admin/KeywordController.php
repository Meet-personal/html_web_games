<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Keyword;


class KeywordController extends Controller
{

    public function index()
    {
        return view('admin.keyword.index');
    }

    public function getKeyword()
    {
        // Initialize the query with the country relationship
        $keywords = Game::with(['game:id,game_id,name']);

        return DataTables::of($keywords)
            ->addColumn('game_id', function ($keyword) {
                return $keyword->name ? $keyword->game->name : "";
            })
            ->addColumn('game_keyword', function ($keyword) {
                return $keyword->game_keyword;
            })
            ->addColumn('action', function ($keyword) {
                return '<a class="btn-icon text-info" href="#" onclick="editItem(' . $keyword->id . ')"><i class="bi bi-pencil"></i></a>';
            })
            ->rawColumns(['action']) // Include rawColumns only for HTML content
            ->make(true);
    }
    
    public function create()
    {
        $games = $this->getGameSchema()->get();
        return view('admin.keyword.create', compact('games'));
    }
    public function store(Request $request)
    {
        // dd($request['game_keyword']);

        $request->validate([
            'game_id' => 'required|string|max:100',
           'game_keyword' => 'required|max:100|unique:game_keyword',

        ]);

        // $games = $this->getGameSchema()->get();

        foreach ($request['game_keyword'] as $keyword) {
            Keyword::create([
                'game_id' => $request->game_id,
                'game_keyword' => $keyword,
            ]);
        }

        // dd(123);
        return redirect()->route('admin.keyword.index');
    }
    public function edit($id)
    {
        $games = $this->getGameSchema()->get();
        $keyword = Keyword::find($id);

        return view('admin.keyword.edit', compact('games'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'game_id' => 'required|string|max:100',
            'game_keyword' => $request->input('game_keyword'),

        ]);

        $keyword = Keyword::find($id);
        $keyword->game_id = $request->input('game_id');
        $keyword->game_keyword = $request->input('game_keyword');

        $keyword->update();
        return redirect()->route('admin.keyword.index');
    }

    protected function getGameSchema()
    {
        return Game::where('status', 1)->select('id', 'name');
    }
}
