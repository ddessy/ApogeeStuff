<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MazeGameResult;
use App\Models\PuzzleGamesResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ResultsController extends Controller
{
    public function viewResultsPage()
    {
        $games = Game::all();
        $usersCount = count(User::all());

        return view('results.viewResults', ['games' => $games, 'usersCount' => $usersCount]);
    }

    public function gameResultsPage(Request $request)
    {
        $request->validate([
            'gameId' => 'required',
        ]);

        $gameId = $request->gameId;
        $game = Game::find($gameId);
        $results = MazeGameResult::where('maze_game_id', $gameId)->get();
        $users = User::all();
        $miniGames = PuzzleGamesResult::select('puzzle_game_name')->where('maze_game_id', $gameId)->groupBy('puzzle_game_name')->get();

        return view('results.gameResults', ['game' => $game, 'results' => $results, 'users' => $users, 'miniGames' => $miniGames]);
    }

    public function getMiniGameResults(Request $request)
    {
        $request->validate([
            'hallAndMiniGame' => 'required',
        ]);

        $hallAndMiniGame = $request->hallAndMiniGame;
        $gameId = $request->gameId;
        $results = PuzzleGamesResult::where('puzzle_game_name', $hallAndMiniGame)->where('maze_game_id', $gameId)->get();
        $users = User::all();

        return redirect()->route('results.miniGameResults')->with(['hallAndMiniGame' => $hallAndMiniGame, 'results' => $results, 'users' => $users]);
    }

    public function miniGameResultsPage()
    {
        if (Session()->has('hallAndMiniGame')) {
            return view('results.miniGameResults');
        }

        return redirect()->back();
    }
}
