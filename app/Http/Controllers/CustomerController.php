<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 *
 */
class CustomerController extends APIController
{
    /**
     * @var CustomerService
     */
    protected $service;
    /**
     * @var
     */
    protected $model;

    /**
     * @param CustomerService $companyService
     */
    public function __construct(CustomerService $companyService)
    {
        $this->service = $companyService;
    }

    /**
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
     * @param CreateCustomerRequest $request
     * @return JsonResponse
     */
    public function store(CreateCustomerRequest $request): JsonResponse
    {
        $this->model = $this->service->create($request);
        return $this->respondOk(new CustomerResource ($this->model));

    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        return $this->respondOk(new CustomerResource($customer));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomerRequest $request
     * @return JsonResponse
     */
    public function update(UpdateCustomerRequest $request): JsonResponse
    {
        $this->model = $this->service->update($request);
        return $this->respondOk((new CustomerResource($this->model)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer): JsonResponse
    {
        //
        $customer->delete();
        $data = [
            'message' => 'Customer has been deleted.'
        ];
        return $this->respondOk($data);
    }
}
