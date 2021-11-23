<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

/**
 *
 */
class CompanyService
{
    /**
     * @var CompanyRepository
     */
    protected $repository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->repository = $companyRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $company = $this->repository->index();
        return $company;
    }

    /**
     * @param Request $request
     * @return Company
     */
    public function create(Request $request): Company
    {
        $company = $this->repository->store($request->all());
        return $company;
    }

    /**
     * @param Request $request
     * @return Company
     */
    public function update(Request $request): Company
    {
        $company = $this->repository->findOrFail($request->id);
        $company = $this->repository->update($company, $request->only(Company::UpdatableAttributes));
        return $company;
    }
}
