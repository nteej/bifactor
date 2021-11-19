<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends APIController
{
    protected $service;
    protected $model;

    public function __construct(CompanyService $companyService)
    {
        $this->service = $companyService;
    }

    public function index(){
        $this->model=$this->service->index();
        return $this->respondOk($this->model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $this->model=$this->service->create($request);
        return $this->respondOk(new CompanyResource ($this->model));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Company $company
     * @return Response
     */
    public function show(Company $company): JsonResponse
    {
        return $this->respondOk(new CompanyResource($company));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request):JsonResponse
    {
        $this->model=$this->service->update($request);
        return $this->respondOk((new CompanyResource($this->model)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company $company
     * @return Response
     */
    public function destroy(Company $company):JsonResponse
    {
        //
        $company->delete();
        $data=[
            'message'=>'Company has been deleted.'
        ];
        return $this->respondOk($data);
    }
}
