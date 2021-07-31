<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use Illuminate\Routing\Controller;

class GameApiController extends Controller
{
    public function getGames()
    {
        $games = Game::all();
        return response()->json($games, 200);
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
