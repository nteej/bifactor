<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $data = $request->validated();
        $company = Company::create($data);
        return $this->respondOk(new CompanyResource ($company));

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
     * @return Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company $company
     * @return Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
