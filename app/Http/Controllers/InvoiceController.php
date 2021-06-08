<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Item;
use App\Models\InvoicesItems;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoiceExport;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('sales.invoices.index')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('sales.invoices.create', compact('customers','items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $invoice = Invoice::create([
            'invoice_no' => $request->input('invoice_no'),
            'invoice_date'=> $request->input('invoice_date'),
            'due_date'=> $request->input('due_date'),
            'customer_id'=> $request->input('customer_id'),
            'sub_total' => 0,
            'discount' => 0,
            'total' => 0,
        ]);

        
        return $invoice->id;
    }

    public function storeInvoice(Request $request){

        $invoice = $request->invoice_id;
        $item = $request->item_id;
        $invoice_items = InvoicesItems::create([
            'invoice_id'=> $invoice,
            'item_id'=> $item,
            'quantity'=>$item->quantity
        ]);

        // dd($items);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('sales.invoices.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update([
            'invoice_no' => 'invoice',
            'invoice_date'=> $request->input('invoice_date'),
            'due_date'=> $request->input('due_date'),
            'customer_id'=> $request->input('customer_id'),
            'sub_total' => $request->input('sub_total'),
            'discount' => $request->input('discount'),
            'total' => $request->input('total')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect('/invoices');
    }
    public function export() 
    {
        return Excel::download(new InvoiceExport, 'invoice.xlsx');
    }
   
}
