<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;

class BarcodeWebController extends Controller
{
    public function generate_barcode($id)
    {
        try {
            $aset = Aset::find($id);

            $pdfFileName = Str::slug($id) . '.pdf';

            // Generate QR Code 128
            $barcode = new DNS1D();
            $barcodeData = $barcode->getBarcodeHTML($id, 'C128');

            // Create PDF
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $dompdf = new Dompdf($options);

            // Load HTML with barcode image and text
            $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Barcode PDF</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                        }
                        .barcode-container {
                            margin: auto;
                            text-align: center;
                        }
                        .barcode {
                            display: inline-block;
                        }
                        .barcode-text {
                            margin-top: 5px;
                        }
                    </style>
                </head>
                <body>
                    <div class="barcode-container">
                        <div class="barcode">' . $barcodeData . '</div>
                        <div class="barcode-text">' . $id . '</div>
                    </div>
                </body>
                </html>';

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Return PDF as download
            return $dompdf->stream($pdfFileName);
        } catch (Exception $e) {
            alert()->error('Gagal', $e->getMessage());
            return redirect()->back();
        }
    }
}
