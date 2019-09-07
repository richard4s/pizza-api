<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Product;

use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function cart() {
        return view('cart');
    }

    public function checkout() {
        return view('checkout');
    }

    public function addToCart(Request $request) {
        if($request->all()) {

//            return response()->json(['success' => $request['token']], 200);

            $value = $request['token'];
            $allProduct = DB::table('products')->where('id', '=', $request['id'])->first();

            Cart::session($value)->add([
                'id' => $request['id'],
                'name' => $allProduct['productName'],
                'price' => $allProduct['productPrice'],
                'quantity' => 1,
                'attributes' => [
                    'image' => $allProduct['productImage'],
                    'description' => $allProduct['productDescription'],
                    'category' => $allProduct['productCategory']
                ]
            ]);

            return response()->json(['success' => 'Successfully added to cart'], 200 );

//            Cart::session($value);
            try {
                Cart::session($value)->add([
                    'id' => $request['id'],
                    'name' => $allProduct['productName'],
                    'price' => $allProduct['productPrice'],
                    'quantity' => 1,
                    'attributes' => [
                        'image' => $allProduct['productImage'],
                        'description' => $allProduct['productDescription'],
                        'category' => $allProduct['productCategory']
                    ]
                ]);

                return response()->json(['success' => 'Successfully added to cart'], 200 );
            } catch (\Exception $e) {
                return response()->json(['error' => 'Could not add to cart'], 200 );
            }


//            print_r(Cart::getContent()->count());
//            print_r(Cart::getContent());

        }
    }

    public function removeCart(Request $request) {
        if($request->all()) {
            $value = session()->get('_token');
            Cart::session($value)->remove($request['id']);
        }
    }

    public function clearCart(Request $request) {
        if($request->all()) {
            $value = session()->get('_token');
            Cart::clear();
            Cart::session($value)->clear();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
