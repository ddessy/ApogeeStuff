<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use App\Models\PuzzleGamesResult;
use Illuminate\Routing\Controller;

class MiniGameApiController extends Controller
{
    public function getMiniGames($gameId)
    {
        $miniGames = PuzzleGamesResult::select('puzzle_game_name')->where('maze_game_id', $gameId)->groupBy('puzzle_game_name')->get();
        return response()->json($miniGames, 200);
    }

    public function getGame($id)
    {
        return Game::find($id);
    }

//    public function createGame(Request $request)
//    {
//        return Game::create($request->all());
//    }
//
//    public function updateGame(Request $request, $id)
//    {
//        $article = Game::findOrFail($id);
//        $article->update($request->all());
//
//        return $article;
//    }
//
//    public function deleteGame(Request $request, $id)
//    {
//        $article = Game::findOrFail($id);
//        $article->delete();
//
//        return 204;
//    }
}
