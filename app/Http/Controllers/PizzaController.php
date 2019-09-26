<?php

namespace App\Http\Controllers;

use App\Mail\confirmOrder;
use Illuminate\Http\Request;
use App\Pizza;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


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

    public function onePizza($id = null) {
        $pizza =  DB::table('products')->where('id', '=', $id)->first();
        return response()->json(['success' => 'Pizza Found Successfully',
                                    'pizza' => $pizza], 200);
    }

    public function confirmOrder(Request $request) {
        if($request->all()) {
            $pizza = DB::table('products')->where('id', '=', $request['id'])->first();

            $firstName = $request['firstName'];
            $lastName = $request['lastName'];
            $email = $request['email'];
            $pizzaName = $pizza->productName;
            $pizzaPrice = $pizza->productPrice;


            try {
                Mail::to($request['email'])->send(new confirmOrder($firstName, $lastName, $email, $pizzaName, $pizzaPrice));
                return response()->json(['success' => 'Email Sent Successfully'], 200);
            } catch(\Exception $e) {
                return response()->json(['error' => 'Email Not Sent'], 400);
            }
        }

    }
}
