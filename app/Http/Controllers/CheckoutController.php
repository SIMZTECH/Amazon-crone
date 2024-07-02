<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Psy\Readline\Hoa\Console;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stripe = new \Stripe\StripeClient("sk_test_51PXedMJHw4z8WsrBdiam5BYWa0QrtCjkX3cUOxW9ZKKwDQhcRXbzEz0jkscScwMXTMV8Uu3flOS5dNFtVtF9kkb800XaYtxoui");

        $order = Order::where("user_id",auth()->user()->id)
        ->where("payment_intent",null)
        ->first();

        // if(is_null($order)){
        //     return redirect()->route('checkout_success.index');
        // }

        $intent=$stripe->paymentIntents->create([
            "amount"=>500,
            "currency"=> "usd",
            "payment_method_types"=>['card'],
        ]);
        return Inertia::render("Checkout",[
            "intent"=> $intent,
            "order"=>$order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // find order if exists
        $res = Order::where("user_id",auth()->user()->id)
        ->where("payment_intent",null)
        ->first();

        if(!is_null($res)){
            // perform an update
            $res->total=$request->total;
            $res->total_decimal=$request->total_decimal;
            $res->items=json_encode($request->items);
            $res->save();
        }else{
            // new order
            $res = new Order();
            $res->user_id=auth()->user()->id;
            $res->total=$request->total;
            $res->total_decimal=$request->total_decimal;
            $res->items=json_encode($request->items);
            $res->save();
        }

        return redirect()->route('checkout.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $order = Order::where("user_id",auth()->user()->id)
        ->where("payment_intent",null)
        ->first();

        $order->payment_intent= $request['payment_intent'];
        $order->save();

        // SEND MAILL:Sucessfull paymnet
        Mail::to($request->user())->send(new OrderShipped($order));

        return redirect()->route('checkout_success');
    }

}
