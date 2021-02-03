<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MazeGameResult;
use App\Models\PuzzleGamesResult;
use App\Models\User;
use Illuminate\Routing\Controller;

class ResultsController extends Controller
{
    public function indexPage()
    {
        $games = Game::all();

        $results = MazeGameResult::all();

        $users = User::all();

        return view('pages.results.index', ['games' => $games, 'results' => $results, 'users' => $users]);
    }

    public function hallResultsPage()
    {
        $results = MazeGameResult::all();

        $users = User::all();

        $miniGames = PuzzleGamesResult::select('puzzle_game_name')->groupBy('puzzle_game_name')->get();

        return view('pages.results.hallResults', ['results' => $results, 'users' => $users, 'miniGames' => $miniGames]);
    }

    public function miniGameResultsPage()
    {
        $results = MazeGameResult::orderBy('id')
            ->get();

        return view('pages.results.miniGameResults', ['results' => $results]);
    }
}
