<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data transaksi stok beserta data barang untuk laporan.
        $query = StockTransaction::with('product');

        // Jika tanggal awal dan akhir diisi, laporan difilter berdasarkan rentang tanggal.
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Mengurutkan transaksi dari tanggal terbaru agar laporan lebih mudah dibaca.
        $transactions = $query->orderBy('date', 'desc')->get();

        return view('reports.index', compact('transactions'));
    }

    public function print(Request $request)
    {
        // Menyiapkan data transaksi stok untuk halaman cetak laporan.
        $query = StockTransaction::with('product');

        // Filter laporan cetak berdasarkan rentang tanggal jika keduanya diisi.
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Data dicetak dari transaksi terbaru ke yang paling lama.
        $transactions = $query->orderBy('date', 'desc')->get();

        return view('reports.print', compact('transactions'));
    }

        public function pdf(Request $request)
    {
        // Menyiapkan data transaksi stok untuk dibuat menjadi file PDF.
        $query = StockTransaction::with('product');

        // Filter PDF berdasarkan tanggal jika user mengisi tanggal awal dan akhir.
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Mengambil data laporan dengan urutan tanggal terbaru.
        $transactions = $query->orderBy('date', 'desc')->get();

        // Membuat file PDF dari view khusus laporan PDF.
        $pdf = Pdf::loadView('reports.pdf', compact('transactions'));

        // Mengunduh PDF dengan nama file laporan-persediaan.pdf.
        return $pdf->download('laporan-persediaan.pdf');
    }

    public function excel(Request $request)
    {
        // Menyiapkan data transaksi stok untuk diekspor ke file CSV.
        $query = StockTransaction::with('product');
    
        // Filter data ekspor berdasarkan rentang tanggal jika tersedia.
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
    
        // Mengambil data transaksi dari yang terbaru.
        $transactions = $query->orderBy('date', 'desc')->get();
    
        // Nama file yang akan diunduh oleh pengguna.
        $fileName = 'laporan-persediaan.csv';
    
        // Header ini memberi tahu browser bahwa response adalah file CSV untuk diunduh.
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];
    
        // Callback digunakan untuk menulis isi CSV langsung ke output response.
        $callback = function () use ($transactions) {
            $file = fopen('php://output', 'w');
    
            // Baris pertama CSV berisi judul kolom laporan.
            fputcsv($file, [
                'No',
                'Tanggal',
                'Kode Barang',
                'Nama Barang',
                'Jenis',
                'Jumlah',
                'Keterangan',
            ]);
    
            // Setiap transaksi ditulis menjadi satu baris data di file CSV.
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
    
        // Mengirim file CSV sebagai response download.
        return response()->stream($callback, 200, $headers);
    }

}
