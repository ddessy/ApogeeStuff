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

        return view('pages.results.viewResults', ['games' => $games, 'usersCount' => $usersCount]);
    }

    public function gameResultsPage(Request $request)
    {
        $request->validate([
            'chosenGameId' => 'required',
        ]);

        $chosenGameId = $request->chosenGameId;
        $game = Game::find($chosenGameId);
        $results = MazeGameResult::where('maze_game_id', $chosenGameId)->get();
        $users = User::all();
        $miniGames = PuzzleGamesResult::select('puzzle_game_name')->where('maze_game_id', $chosenGameId)->groupBy('puzzle_game_name')->get();

        return view('pages.results.gameResults', ['game' => $game, 'results' => $results, 'users' => $users, 'miniGames' => $miniGames]);
    }

    public function getMiniGameResults(Request $request)
    {
        $request->validate([
            'chosenHallAndMiniGame' => 'required',
        ]);

        $chosenHallAndMiniGame = $request->chosenHallAndMiniGame;
        $gameId = $request->gameId;
        $results = PuzzleGamesResult::where('puzzle_game_name', $chosenHallAndMiniGame)->where('maze_game_id', $gameId)->get();
        $users = User::all();

        return redirect('/view-results/mini-game-results')->with(['chosenHallAndMiniGame' => $chosenHallAndMiniGame, 'results' => $results, 'users' => $users]);
    }

    public function miniGameResultsPage()
    {
        if (Session()->has('chosenHallAndMiniGame')) {
            return view('pages.results.miniGameResults');
        }

        return redirect()->back();
    }
}
