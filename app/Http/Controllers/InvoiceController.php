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
class InvoiceController extends Controller
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
     * @OA\Get(
     *      path="/invoices",
     *      tags={"Invoice(Creditor's)"},
     *      summary="Get list of Invoices",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/InvoiceResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index(): JsonResponse
    {
        try {
            $this->model = $this->service->index();
            return $this->respondSuccess(new InvoiceResource ($this->model));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateInvoiceRequest $request
     * @return JsonResponse
     */
    public function store(CreateInvoiceRequest $request): JsonResponse
    {
        try {
            $this->model = $this->service->create($request);
            return $this->respondSuccess(new InvoiceResource ($this->model));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function show(Invoice $invoice): JsonResponse
    {
        try {
            return $this->respondOk(new InvoiceResource($invoice));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoiceRequest $request
     * @return JsonResponse
     */
    public function update(UpdateInvoiceRequest $request): JsonResponse
    {
        try {
            $this->model = $this->service->update($request);
            return $this->respondOk((new InvoiceResource($this->model)));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return JsonResponse
     */
    public function destroy(Invoice $invoice): JsonResponse
    {
        try {
            $invoice->delete();
            $data = [
                'message' => 'Invoice has been deleted.'
            ];
            return $this->respondOk($data);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * @param InvoiceByCustomerRequest $request
     * @return JsonResponse
     */
    public function listByCustomer(InvoiceByCustomerRequest $request): JsonResponse
    {
        try {
            $invoices = $this->service->listByCustomer($request->customer_id);
            return response()->json($invoices);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function listByCompany(InvoiceByCompanyRequest $request): JsonResponse
    {
        try {
            $invoices = $this->service->listByCompany($request->company_id);
            return response()->json($invoices);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function process(InvoiceProcessRequest $request): JsonResponse
    {
        try {
            $invoices = $this->service->openInvoice($request);
            return response()->json($invoices);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function makePayment(InvoicePaymentRequest $request): JsonResponse
    {
        try {
            $invoices = $this->service->makePayment($request);
            return response()->json($invoices);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function invoiceStatus(Request $request, $id): JsonResponse
    {
        try {
            $invoices = $this->service->getInvoiceStatus($id);
            return response()->json($invoices);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
