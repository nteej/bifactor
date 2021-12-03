<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class CustomerController extends Controller
{
    /**
     * @var CustomerService
     */
    protected $service;
    /**
     * @var
     */
    protected $model;

    /**
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
    }

    /**
     * @OA\Get(
     *      path="/customers",
     *      tags={"Customer(Debitors)"},
     *      summary="Get list of customers",
     *      description="Returns list of customers",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CustomerResource")
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
     *      path="/customers",
     *      tags={"Customer(Debitors)"},
     *      summary="Create a Customer",
     *      description="Create new Customer",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCustomerRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Customer created Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer created Successfully",
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

    public function store(CreateCustomerRequest $request): JsonResponse
    {
        try {
            $this->model = $this->service->create($request);
            return $this->respondWithResource(new CustomerResource ($this->model));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }

    }

    /**
     * @OA\Get(
     *      path="/customers/{uuid}",
     *      tags={"Customer(Debitors)"},
     *      summary="Get customer information",
     *      description="Returns customer data",
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
     *          @OA\JsonContent(ref="#/components/schemas/Customer")
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
    public function show(Customer $customer): JsonResponse
    {
        try {
            return $this->respondOk(new CustomerResource($customer));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }


    /**
     * @OA\Put(
     *      path="/customers/{uuid}",
     *      tags={"Customer(Debitors)"},
     *      summary="Update selected customer",
     *      description="Update selected customer",
     *      security={ * {"sanctum": {}}, * },
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Customer id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCustomerRequest")
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
    public function update(UpdateCustomerRequest $request): JsonResponse
    {
        try {
            $this->model = $this->service->update($request);
            return $this->respondOk((new CustomerResource($this->model)));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    /**
     * @OA\Delete (
     *      path="/customers/{uuid}",
     *      tags={"Customer(Debitors)"},
     *      summary="Delete selected customer",
     *      description="Delete selected customer",
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
    public function destroy(Customer $customer): JsonResponse
    {
        //
        try {
            $customer->delete();
            $data = [
                'message' => 'Customer has been deleted.'
            ];
            return $this->respondOk($data);
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }
}
