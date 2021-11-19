<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use \App\Models\Company;

class CompanyService
{
    protected $repository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->repository = $companyRepository;
    }

    public function index()
    {
        $company = $this->repository->index();
        return $company;
    }

    public function create(Request $request): Company
    {
        $company = $this->repository->store($request->all());
        return $company;
    }

    public function update(Request $request): Company
    {
        $company = $this->repository->findOrFail($request->id);
        $company = $this->repository->update($company, $request->only(Company::UpdatableAttributes));
        return $company;
    }
}
