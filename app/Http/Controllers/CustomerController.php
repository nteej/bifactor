<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends APIController
{
    protected $service;
    protected $model;

    public function __construct(CustomerService $companyService)
    {
        $this->service = $companyService;
    }

    public function index()
    {
        $this->model = $this->service->index();
        return $this->respondOk($this->model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCustomerRequest $request
     * @return JsonResponse
     */
    public function store(CreateCustomerRequest $request)
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
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        //
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
     * @param \App\Models\Customer $customer
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
