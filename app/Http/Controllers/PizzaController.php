<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

use Illuminate\Support\Facades\DB;

class PizzaController extends Controller {
    //
    public function __construct() {
        $this->middleware('guest');
    }

    public function index() {

        $allPizzas =  DB::table('products')->get();

        return response()->json(['success' => 'You have returned all pizzas successfully!',
                                    'pizza' => $allPizzas], 200);
    }
}
