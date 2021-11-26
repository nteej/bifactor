<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;


class CompanyRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        dd(Company::all());
        return Company::paginate(10);
    }

    /**
     * @param array $attributes
     * @return Company
     */
    public function store(array $attributes): Company
    {
        return Company::create($attributes);
    }

    /**
     * @param Company $company
     * @param array $attributes
     * @return Company
     */
    public function update(Company $company, array $attributes): Company
    {
        $company->update($attributes);
        return $company;
    }

    /**
     * @param int $id
     * @return Company
     */
    public function findOrFail(int $id): Company
    {
        return Company::findOrFail($id);
    }
}
