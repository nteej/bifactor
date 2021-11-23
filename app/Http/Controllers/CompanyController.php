<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class CompanyController extends APIController
{
    /**
     * @var CompanyService
     */
    protected $service;
    /**
     * @var
     */
    protected $model;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
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
     * @param CreateCompanyRequest $request
     * @return JsonResponse
     */
    public function store(CreateCompanyRequest $request): JsonResponse
    {
        $this->model = $this->service->create($request);
        return $this->respondOk(new CompanyResource ($this->model));

    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return $this->respondOk(new CompanyResource($company));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request): JsonResponse
    {
        $this->model = $this->service->update($request);
        return $this->respondOk((new CompanyResource($this->model)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        //
        $company->delete();
        $data = [
            'message' => 'Company has been deleted.'
        ];
        return $this->respondOk($data);
    }
}
