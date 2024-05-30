<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function index($id)
    {
        $work = Work::findOrFail($id);
        $invoice = $work->invoice;
        return view('admin.work.invoice.index', compact('invoice', 'work'));
    }

    public function create($work_id)
    {
        return view('admin.work.invoice.create',['work_id' => $work_id]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'amount' => 'required|numeric',
            'work_id' => 'required|exists:works,id',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:5120',
        ]);
        
        $invoiceid = time() . $request->work_id;
        $validatedData['invoiceid'] = $invoiceid;

        if ($request->hasFile('img')) { 
            $file = $request->file('img'); 
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $storagePath = public_path('images/invoices');
            $file->move($storagePath, $filename);
            $validatedData['img'] = 'images/invoices/' . $filename;
        }
        $invoice = Invoice::create($validatedData);

        return redirect()->route('work.invoice', ['id' => $validatedData['work_id']])->with('success', 'Invoice created successfully.');
    }

    public function update(Request $request, $work_id)
    {
        $invoice = Invoice::where('work_id', $work_id)->firstOrFail();

        $validatedData = $request->validate([
            'date' => 'required',
            'amount' => 'required|numeric',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:5120',
        ]);

        $previousImagePath = $invoice->img;

        $invoice->date = $validatedData['date'];
        $invoice->amount = $validatedData['amount'];

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            $storagePath = public_path('images/invoices');
            $file->move($storagePath, $filename);
            $validatedData['img'] = 'images/invoices/' . $filename;
            
            if ($previousImagePath) {
                $oldImagePath = public_path($previousImagePath);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $invoice->update($validatedData);

        return redirect()->route('work.invoice', ['id' => $work_id])->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::where('id', $id)->firstOrFail();

        if ($invoice->img) {
            $imagePath = public_path($invoice->img);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $invoice->delete();

        return back()->with('success', 'Invoice deleted successfully.');
    }

    public function showInvoice(Work $work)
    {
        $invoice = $work->invoice;
        return view('user.invoice.details', compact('invoice'));
    }

    public function showInvoiceApi(Work $work)
    {
        $invoice = $work->invoice;
        return response()->json(['invoice' => $invoice]);
    }

}
