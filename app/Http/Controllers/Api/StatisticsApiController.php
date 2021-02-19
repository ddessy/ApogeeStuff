<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatisticsApiController extends Controller
{
    public function calculateGameResult(Request $request)
    {
        $games = Game::all();
        return response()->json($request, 200);
    }

    public function calculateMiniGameResult(Request $request)
    {
        $games = Game::all();
        return response()->json($request, 200);
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
