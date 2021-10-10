<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use Illuminate\Routing\Controller;

// Methods called in api.php
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
}