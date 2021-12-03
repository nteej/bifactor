<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


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
     * @OA\Get(
     *      path="/companies",
     *      tags={"Company(Creditors)"},
     *      summary="Get list of copanies",
     *      description="Returns list of copanies",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index(): JsonResponse
    {

        try {
            $this->model = $this->service->index();
            return $this->respondWithResource($this->model);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/companies",
     *      tags={"Company(Creditors)"},
     *      summary="Create a Company",
     *      description="Create new Company",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCompanyRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Company created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Company created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(CreateCompanyRequest $request): JsonResponse
    {
        try {
            $this->model = $this->service->create($request);
            return $this->respondWithResource(new CompanyResource ($this->model), '', ResponseAlias::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }

    }

    /**
     * @OA\Get(
     *      path="/companies/{uuid}",
     *      tags={"Company(Creditors)"},
     *      summary="Get company information",
     *      description="Returns company data",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Comapany uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Company")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *    )
     */
    public function show(Company $company): JsonResponse
    {
        try {
            return $this->respondWithResource(new CompanyResource($company));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }


    /**
     * @OA\Put(
     *      path="/companies/{uuid}",
     *      tags={"Company(Creditors)"},
     *      summary="Update selected company",
     *      description="Update selected company",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Company id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCompanyRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function update(UpdateCompanyRequest $request): JsonResponse
    {
        try {
            $this->model = $this->service->update($request);
            return $this->respondWithResource((new CompanyResource($this->model)));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * @OA\Delete (
     *      path="/companies/{uuid}",
     *      tags={"Company(Creditors)"},
     *      summary="Delete selected company",
     *      description="Delete selected company",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Comapany uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function destroy(Request $request, Company $company): JsonResponse
    {
        //
        try {
            $company->delete();
            return $this->respondSuccess('Company Deleted successfully');
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }

    }
}
