<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoiceRequest;
use App\Http\Requests\InvoiceByCompanyRequest;
use App\Http\Requests\InvoiceByCustomerRequest;
use App\Http\Requests\InvoicePaymentRequest;
use App\Http\Requests\InvoiceProcessRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class InvoiceController extends APIController
{
    /**
     * @var InvoiceService
     */
    protected $service;
    /**
     * @var
     */
    protected $model;

    /**
     * @param InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->service = $invoiceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->model = $this->service->index();
        return $this->respondOk($this->model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateInvoiceRequest $request
     * @return JsonResponse
     */
    public function store(CreateInvoiceRequest $request): JsonResponse
    {
        $this->model = $this->service->create($request);
        return $this->respondOk(new InvoiceResource ($this->model));
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function show(Invoice $invoice): JsonResponse
    {
        return $this->respondOk(new InvoiceResource($invoice));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoiceRequest $request
     * @return JsonResponse
     */
    public function update(UpdateInvoiceRequest $request): JsonResponse
    {
        $this->model = $this->service->update($request);
        return $this->respondOk((new InvoiceResource($this->model)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function destroy(Invoice $invoice): JsonResponse
    {
        $invoice->delete();
        $data = [
            'message' => 'Invoice has been deleted.'
        ];
        return $this->respondOk($data);
    }

    /**
     * @param InvoiceByCustomerRequest $request
     * @return JsonResponse
     */
    public function listByCustomer(InvoiceByCustomerRequest $request): JsonResponse
    {
        $invoices = $this->service->listByCustomer($request->customer_id);
        return response()->json($invoices);
    }

    public function listByCompany(InvoiceByCompanyRequest $request): JsonResponse
    {
        $invoices = $this->service->listByCompany($request->company_id);
        return response()->json($invoices);
    }

    public function process(InvoiceProcessRequest $request): JsonResponse
    {
        $invoices = $this->service->openInvoice($request);
        return response()->json($invoices);
    }

    public function makePayment(InvoicePaymentRequest $request): JsonResponse
    {
        $invoices = $this->service->makePayment($request);
        return response()->json($invoices);
    }

    public function invoiceStatus(Request $request, $id): JsonResponse
    {
        $invoices = $this->service->getInvoiceStatus($id);
        return response()->json($invoices);
    }
}
