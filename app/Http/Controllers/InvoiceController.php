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

        $this->validate($request, [
            'invoice_no' => 'unique',
            'invoice_date' => 'required|after_or_equal:today',
            'due_date' => 'reuqired',
            'customer_id' => 'required'
        ]);

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
        
        $invoice_id = $request->get('invoice_id');
        $item = Item::where('name','=',$request->get('name'))->first();
        $invoice = Invoice::where('id', '=' ,$invoice_id)->first();
        $invoice->items()->attach($item->id, ['quantity' => $request->get('quantity')]);
        $item->decrement('total_quantity',  $request->get('quantity'));
    }

    public function editInvoice(Request $request , $invoice_id){

        $invoice = Invoice::where('id', '=', $invoice_id)->first();
        $invoice->update([
            'sub_total' => $request->get('sub_total'),
            'discount' => $request->get('discount'),
            'total' => $request->get('total')
        ]);

        // return redirect('invoices');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $customer = Customer::where('id', '=', $invoice->customer_id)->first();
        $items = Invoice::find($invoice->id)->items;
      
        return view('sales.invoices.show', compact('invoice', 'customer', 'items'));
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
        $this->validate($request, [
            'invoice_no' => 'unique',
            'invoice_date' => 'required|after_or_equal:today',
            'due_date' => 'reuqired',
            'customer_id' => 'required'
        ]);
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
