<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Company Controller here to manage all activities of invoice 1st owner(the creditor)
 *
 * @package   CreditOwner
 * @author    Nalin Tharanga <nteeje@gmail.com>
 * @version   1.0.1
 *
 */
class CompanyController extends Controller
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

        try {
            $this->model = $this->service->index();
            dd($this->model);
            return $this->respondWithResource($this->model, '');
        } catch (\Exception $e) {
            return $this->failure($e->getMessage());
        }
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
    public function destroy(Request $request, Company $company): JsonResponse
    {
        //
        $company = $company->delete();
        try {
            $data = [
                'success' => true,
                'message' => 'Company has been deleted.',
                'result' => $company
            ];
        } catch (\Exception $exception) {
            $data = [
                'success' => false,
                'message' => $exception->getMessage(),
                'result' => '',
                'error_code' => $exception->getCode()
            ];
        }

        return $this->respondOk($data,);
    }
}
