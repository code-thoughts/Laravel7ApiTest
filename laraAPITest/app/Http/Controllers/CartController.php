<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response = ['message' => 'You have reached the cart section'];
        return response($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request )
    {
        $id = Auth::id(); 
        //
        
        $validator = Validator::make($request->all(), [
            'product' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            //'user_id' => 'required|integer|max:255',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        //;
        $id = Auth::id(); 
        $cart= new Cart();
        $cart->product= $request['product'];
        $cart->country= $request['country'];
        $cart->user_id= $id;
        // add other fields
        $cart->save();
        $response = ['message' => 'Your product has been saved to your cart'];
        return response($response, 200);
        
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
        $response = ['message' =>  '<function name> function'];
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show(Request $request)
    {
        //Show contents only of the person who is logged in and has a token
        
        // $validator = Validator::make($request->all(), [
        //     // 'product' => 'required|string|max:255',
        //     // 'country' => 'required|string|max:255',
        //     //'customer' => 'required|integer|max:255',
        // ]);
        // if ($validator->fails())
        // {
        //     return response(['errors'=>$validator->errors()->all()], 422);
        // }

       
        //  $pro= $request['product'];
        //  $cou= $request['country'];
         $user= Auth::id(); 
       // $cartSearch= Cart::where([['product','=',$pro],['country','=',$cou],['user_id','=',$user]])->first();
       $cartSearch= Cart::where([['user_id','=',$user]])->get();
        
        if($cartSearch!=null)
        {
            $response = ['Your Carts' => $cartSearch ];
            return response($response, 200); 
        }
        else
        {
            $response = ['message' => 'No items to return' ];
            return response($response, 404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        
        $validator = Validator::make($request->all(), [
            'product' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            //'cartId' => 'required|integer|max:255',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

       
        if (Cart::where('id', $id)->exists()) {
            $currentUser= Auth::id();
            $cart = Cart::find($id);
            
            if($cart->user_id == $currentUser)
            {
                $cart->product = $request['product'];
                $cart->country = $request['country'];
                $cart->save();
        
                $response = ['message' => 'Cart updated successfully' ];
                return response($response, 200);
            }
            else
            {
                //if user ids do not match then you cant update that cart
                $response = ['message' => 'This cart is not yours to update' ];
                return response($response, 200);

            }
            

          } else {
            $response = ['message' => 'Cart not found' ];
            return response($response, 404);
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
        
        if (Cart::where('id', $id)->exists()) {
            $currentUser= Auth::id();
            $cart = Cart::find($id);
            
            if($cart->user_id == $currentUser)
            {
                $cart->delete();

                $response = ['message' => 'Cart deleted successfully' ];
                return response($response, 200);
            }
            else
            {
                //if user ids do not match then you cant update that cart
                $response = ['message' => 'This cart is not yours to delete' ];
                return response($response, 200);

            }
            

          } else {
            $response = ['message' => 'Cart not found' ];
            return response($response, 404);
          }

    }
}
