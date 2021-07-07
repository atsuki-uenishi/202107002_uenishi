<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ItemController extends Controller
{
    public function index() {
        $items = Item::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function show(Item $item) {
        $data = Item::where('id', $item->id)->first();
        if($data) {
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
    }
}
