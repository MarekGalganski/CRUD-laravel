<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();

        return view('/cards/index')->with('cards', $cards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'card_number' => 'required|digits:20',
            'pin' => 'required|digits:4',
            'activation_date' => 'required|date_format:Y-m-d H:i',
            'expiry_date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric',
        ]);
        
        Card::create($request->all());

        return redirect()->back()->with('message', 'Card has been added.');
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
        $request->validate([
            'card_number' => 'required|digits:20',
            'pin' => 'required|digits:4',
            'activation_date' => 'required|date_format:Y-m-d H:i:s',
            'expiry_date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric',
        ]);

        $card = Card::find($id);
        
        $card->card_number = $request->input('card_number');
        $card->pin = $request->input('pin');
        $card->activation_date = $request->input('activation_date');
        $card->expiry_date = $request->input('expiry_date');
        $card->amount = $request->input('amount');

        $card->save();

        return redirect()->back()->with('message', 'Card has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();

        return redirect()->back();
    }
}
