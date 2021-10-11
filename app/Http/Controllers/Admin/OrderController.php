<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $invoices = Invoice::latest()->when(request()->q, function($invoices) {
            $invoices = $invoices->where('invoice', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }

    /**
     * show
     *
     * @param  mixed $invoice
     * @return void
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.order.show', compact('invoice'));
    }

    /**
     * update status to success
     *
     * @param  mixed $invoice
     * @return void
     */
    public function success($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'status' => 'success'
        ]);

        if($invoice){
            //redirect dengan pesan sukses
            return redirect()->route('admin.order.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.order.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * update status to failed
     *
     * @param  mixed $invoice
     * @return void
     */
    public function failed($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'status' => 'failed'
        ]);

        if($invoice){
            //redirect dengan pesan sukses
            return redirect()->route('admin.order.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.order.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * show add tracking form
     *
     * @param  mixed $invoice
     * @return void
     */
    public function createTracking($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.order.tracking', compact('invoice'));
    }

     /**
     * update tracking number
     *
     * @param  mixed $invoice
     * @return void
     */
    public function storeTracking($id, Request $request)
    {
        $invoice = Invoice::findOrFail($id);

        $this->validate($request, [
            'tracking_number'            => 'required',
        ]);

        $invoice->update([
            'tracking_number' => $request->tracking_number
        ]);

        if($invoice){
            //redirect dengan pesan sukses
            return redirect()->route('admin.order.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.order.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

}
