<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use App\Models\PuzzleGamesResult;
use Illuminate\Routing\Controller;

// Methods called in api.php
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
}
