<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Movie;
use App\Models\Backend\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Backend\Category;
use App\Models\Backend\Genre;
use App\Models\Backend\Blog;
use App\Models\User;

class CartController extends Controller
{
    public function AddToCard(Request $request, $id){

        // Find the movie/product
        $data = Product::findOrFail($id);

        // Check if the item is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        })->first();

        if ($cartItem) {
            return response()->json(['error' => 'Item is already in your cart']);
        }

        // Calculate the final price: selling_price minus discount_price if available
        $price = $data->discount_price
            ? $data->selling_price - $data->discount_price
            : $data->selling_price;

        // Add the movie/product to the cart
        Cart::add([
            'id' => $id,
            'name' => $request->movie_name,
            'qty' => $request->quantity,
            'price' => $price, // Use the calculated price
            'weight' => 1,
            'options' => [
                'image' => $data->photo,
            ],
        ]);

        // Return the response with updated cart information
        return response()->json([
            'success' => 'Successfully Added to your Cart',
            'cartQty' => Cart::count(),
            'cartTotal' => Cart::subtotal(),
        ]);
    }


    public function AddToCartDetails(Request $request, $id){

        // Find the movie/product
        $data = Product::findOrFail($id);

        // Check if the item is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        })->first();

        if ($cartItem) {
            return response()->json(['error' => 'Item is already in your cart']);
        }

        // Calculate the final price: selling_price minus discount_price if available
        $price = $data->discount_price
            ? $data->selling_price - $data->discount_price
            : $data->selling_price;

        // Add the movie/product to the cart
        Cart::add([
            'id' => $id,
            'name' => $request->movie_name,
            'qty' => $request->quantity,
            'price' => $price, // Use the calculated price
            'weight' => 1,
            'options' => [
                'image' => $data->photo,
            ],
        ]);

        // Return the response with updated cart information
        return response()->json([
            'success' => 'Successfully Added to your Cart',
            'cartQty' => Cart::count(),
            'cartTotal' => Cart::subtotal(),
        ]);
    }// End Method

    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));
    }// End Method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Item Remove From Cart']);

    }// End Method

    public function MyCart(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.mycart.view_mycart',compact('user'));
    }// End Method

    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal

        ));

    }// End Method

    public function CartRemove($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);

    }// End Method


    public function CheckoutCreate(){
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $id = Auth::user()->id;
                $user = User::find($id);

                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','user'));
            }else{
                $notification = array(
                    'message' => 'Shopping At list One Product',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }

    }// End Method


}
