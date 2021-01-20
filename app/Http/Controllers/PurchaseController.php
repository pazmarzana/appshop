<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return $purchases;
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
    // {

    //     $user = Auth::user();
    //     $purchase = new Purchase();
    //     $purchase->user_id = $user->id;
    //     $purchase->app_id = $request->app_id;
    //     $purchase->save();
    //     return $purchase;
    // }

    {

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->type == 0) {

                return back();
            } else {
                $purchasePrevia =  Purchase::where('app_id', '=', $request->app_id)->where('user_id', '=', $user->id)->get();
                if ($purchasePrevia->isEmpty()) {

                    $purchase = new Purchase();
                    $purchase->user_id = $user->id;
                    $purchase->app_id = $request->app_id;
                    $purchase->save();
                    return redirect()->route('apps.index')->with(array(
                        'message' => 'La app se ha comprado correctamente'
                    ));
                } else {

                    return redirect()->route('apps.index')->with(array(
                        'error' => 'La app ya se habia comprado previamente'
                    ));
                }
            }
        } else {

            return redirect()->route('login')->with(array(
                'error' => 'Debe loguearse para poder comprar la aplicacion'
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
