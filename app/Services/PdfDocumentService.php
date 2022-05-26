<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class PdfDocumentService
{
    public function __construct() {
    }

    public function generate($documentId, $data) {
        $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('docs/apply/' . $documentId, $data);
    }
}
