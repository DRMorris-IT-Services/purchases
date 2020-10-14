<?php

namespace App\Http\Controllers;

use App\purchases;
use App\purchases_lines;
use App\suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(purchases $purchases, suppliers $suppliers)
    {
        //
        $supplier = suppliers::join('purchases','suppliers.supplier_id', '=', 'purchases.supplier_id')
        ->select('suppliers.company','suppliers.supplier_id','purchases.supplier_id')->get();

        $unique = $supplier->unique('company');

       return view('purchases.purchases',['purchases' => $purchases->orderby('invoice_date','DESC')->paginate(15), 'supplier' => $unique]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $today = date('Y-m-d');
        $due = date('Y-m-d', strtotime($today. ' + 30 days'));
        $quote_id = Str::random(60);
        
        purchases::create([
            'invoice_id' => $quote_id,
            'invoice_date' => $today,
            'invoice_due' => $due,
            'status' => "Pending Review",
        ]);

        purchases_lines::create([
            'invoice_id' => $quote_id,
        ]);

        return redirect("purchases/edit/$quote_id"); 

        
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
     * @param  \App\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function show(purchases $purchases, purchases_lines $purchases_lines, suppliers $suppliers, $id)
    {
        //

        $supplier = suppliers::join('purchases','suppliers.supplier_id', '=', 'purchases.supplier_id')
        ->where('invoice_id',$id)->get();
        
        return view('purchases.view', ['purchases' => $purchases->where('invoice_id',$id)->get(), 'purchases_lines' => $purchases_lines->where('invoice_id',$id)->get(), 'id' => $id, 'suppliers' => $suppliers->orderby('company','asc')->get(), 'supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function edit(purchases $purchases, purchases_lines $purchases_lines, suppliers $suppliers, $id)
    {
        //

        $supplier = suppliers::join('purchases','suppliers.supplier_id', '=', 'purchases.supplier_id')
        ->select('suppliers.company','purchases.supplier_id')->where('invoice_id',$id)->get();

        $total_net = purchases_lines::where('supplier_id', $id)->sum('line_net');
        $total_tax = purchases_lines::where('supplier_id', $id)->sum('line_tax');
        $grand_total = purchases_lines::where('supplier_id', $id)->sum('line_total');

        
        return view('purchases.edit', ['purchases' => $purchases->where('invoice_id',$id)->get(), 'purchase_lines' => $purchases_lines->where('invoice_id',$id)->get(),
        'total_net' => $total_net, 'total_tax' => $total_tax, 'grand_total' => $grand_total, 'suppliers' => $suppliers->orderby('company','asc')->get(), 'supplier' => $supplier]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchases $purchases, $id)
    {
        //

        purchases::where('invoice_id',$id)
            ->update([
            'supplier_id' => $request['supplier'],
            'invoice_ref' => $request['ref_no'],
            'invoice_date' => $request['quote_date'],
            'invoice_due' => $request['due_date'],
            'status' => $request['status'],
            
            ]);

            return back()->withStatus(__('Quotation successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\purchases  $purchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchases $purchases, purchases_lines $purchases_lines, $id)
    {
        //

        purchases::where('invoice_id',$id)
        ->delete();

        purchases_lines::where('invoice_id',$id)
        ->delete();

        return back()->withdelete(__('Purchase Invoice successfully removed.'));
    }

    public function downloadPDF($id) {
        //$show = invoices::where('invoice_id',$id)->get();

        $show = suppliers::join('purchases','suppliers.supplier_id', '=', 'purchases.supplier_id')->where('invoice_id',$id)->get();
        $lines = purchases_lines::where('invoice_id',$id)->get();
        $name = $show[0]['company'];
        $inv_date = $show[0]['invoice_date'];

       $pdf = PDF::loadView('purchases.pdf', ['invoice' => $show, 'lines' => $lines]);
        
       return $pdf->download("Purchase Invoice $name $inv_date.pdf");

      //return view('invoices.pdf',['invoice' => $show, 'lines' => $lines]);

}
}
