<?php

namespace App\Jobs;

use App\Models\Agreement;
use App\Models\Event;
use App\Models\Document;
use App\Models\Customer;
use App\Models\EventLog;
use Illuminate\Bus\Queueable;
use App\Services\PdfDocumentService;
use App\Services\BrightOfficeService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class GenerateCustomerSignedDocs
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    private function createCustomerDocumentFilename(int $customerId, string $file)
    {
        return $customerId . '-' . sha1($file) . '-' . date('Y-m-d');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PdfDocumentService $pdfDocumentService, BrightOfficeService $brightOfficeService)
    {
        try {
            // generate docs, store docs and mark as esigned
            $loaPdf = $pdfDocumentService->generate('loa', [
                'customer'  => $this->customer,
                'agreement' => Agreement::where('key', 'loa')->firstOrFail()
            ])->output();



            $loaPdfPath = 'documents/' . $this->createCustomerDocumentFilename($this->customer->id, $loaPdf) . '.pdf';
            Storage::put($loaPdfPath, $loaPdf);

            Document::create([
                'customer_id' => $this->customer->id,
                'name'        => 'loa',
                'filename'    => $loaPdfPath
            ]);

            EventLog::record(Event::APPLICATION_LOA_GENERATED, $this->customer->id);

            $contractPdf     = $pdfDocumentService->generate('contract', [
                'customer'  => $this->customer,
                'agreement' => Agreement::where('key', 'contract')->firstOrFail()
            ])->output();
            $contractPdfPath = 'documents/' . $this->createCustomerDocumentFilename($this->customer->id, $contractPdf) . '.pdf';
            Storage::put($contractPdfPath, $contractPdf);

            Document::create([
                'customer_id' => $this->customer->id,
                'name'        => 'contract',
                'filename'    => $contractPdfPath
            ]);
            EventLog::record(Event::APPLICATION_CONTRACT_GENERATED, $this->customer->id);
        } catch (\Exception $e) {
            Log::error('Failed to generate signed docs - ' . $e->getMessage() . ', Line: ' . $e->getFile());
        }
    }
}
