<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = Item::with('tags')->where('user_id', Auth::id())->get()->sortByDesc('id');
        return view('dashboard',
            ['list' => $list]);
    }

    public function create(Request $request)
    {
        return Auth::user()->addItem($request->input('content'));
    }
}
