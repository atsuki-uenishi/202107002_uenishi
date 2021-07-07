<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class OrderDetailController extends Controller
{
    public function index(Request $request) {
        $items = Order_detail::with('User')->with('Item')->with('Order')->where('user_id', $request->user_id)->get();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(Request $request) {
        $item = Order_detail::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }
}
