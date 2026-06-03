<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = StockTransaction::with('product');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->orderBy('date', 'desc')->get();

        return view('reports.index', compact('transactions'));
    }

    public function print(Request $request)
    {
        $query = StockTransaction::with('product');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->orderBy('date', 'desc')->get();

        return view('reports.print', compact('transactions'));
    }

        public function pdf(Request $request)
    {
        $query = StockTransaction::with('product');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $transactions = $query->orderBy('date', 'desc')->get();

        $pdf = Pdf::loadView('reports.pdf', compact('transactions'));

        return $pdf->download('laporan-persediaan.pdf');
    }

    public function excel(Request $request)
    {
        $query = StockTransaction::with('product');
    
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
    
        $transactions = $query->orderBy('date', 'desc')->get();
    
        $fileName = 'laporan-persediaan.csv';
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];
    
        $callback = function () use ($transactions) {
            $file = fopen('php://output', 'w');
    
            fputcsv($file, [
                'No',
                'Tanggal',
                'Kode Barang',
                'Nama Barang',
                'Jenis',
                'Jumlah',
                'Keterangan',
            ]);
    
            foreach ($transactions as $index => $transaction) {
                fputcsv($file, [
                    $index + 1,
                    $transaction->date,
                    $transaction->product->code ?? '-',
                    $transaction->product->name ?? '-',
                    ucfirst($transaction->type),
                    $transaction->quantity,
                    $transaction->description,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }

}