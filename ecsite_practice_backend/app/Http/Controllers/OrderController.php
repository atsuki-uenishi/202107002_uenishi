<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index() {
        $items = Order::with('User')->with('Item')->get();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(Request $request) {
        $item = Order::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
