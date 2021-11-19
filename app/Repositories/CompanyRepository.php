<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Company();
    }

    public function index()
    {
        return $this->model->paginate(10);
    }

    public function findOrFail(int $id): Company
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attributes): Company
    {
        return $this->model->create($attributes);
    }

    public function update(Company $company, array $attributes): Company
    {
        $company->update($attributes);
        return $company;
    }
}
