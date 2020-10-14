<?php

namespace duncanrmorris\purchases\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use App\purchases;
use App\purchases_lines;
use Illuminate\Http\Request;

class PurchasesLinesController extends Controller
{
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
    public function create($id)
    {
        //
        purchases_lines::create([
            'invoice_id' => $id,
        ]);

        return back()->withstatus(__('Quotation Line successfully added.'));
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
     * @param  \App\purchases_lines  $purchases_lines
     * @return \Illuminate\Http\Response
     */
    public function show(purchases_lines $purchases_lines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\purchases_lines  $purchases_lines
     * @return \Illuminate\Http\Response
     */
    public function edit(purchases_lines $purchases_lines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchases_lines  $purchases_lines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchases_lines $purchases_lines, $id, $iid)
    {
        //
        $qty =  $request['qty'];
        $price = $request['price'];

        $net = $qty * $price;
        if($request['no-tax'] == "on")
        {
            $tax = 0;
        }else{
        $tax = $net * 0.19;
        }
        $total = $net + $tax;

        purchases_lines::where('id',$id)
            ->update([
            'qty' => $request['qty'],
            'description' => $request['description'],
            'line_price' => $request['price'],
            'line_net' => $net,
            'line_tax' => $tax,
            'line_tax_exempt' => $request['no-tax'],
            'line_total' => $total,
            
            ]);

            $total_net = purchases_lines::where('invoice_id', $iid)->sum('line_net');
            $total_tax = purchases_lines::where('invoice_id', $iid)->sum('line_tax');
            $grand_total = purchases_lines::where('invoice_id', $iid)->sum('line_total');

            purchases::where('invoice_id',$iid)
            ->update([
            'net_total' => $total_net,
            'tax_total' => $total_tax,
            'grand_total' => $grand_total,
            ]);

            return back()->withStatus(__('Purchase Line successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\purchases_lines  $purchases_lines
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchases_lines $purchases_lines)
    {
        //
    }
}
