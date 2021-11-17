<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFcOrderRequest;
use App\Http\Requests\UpdateFcOrderRequest;
use App\Http\Resources\FcOrderResource;
use App\Models\FcOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FcOrderController extends APIController
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
     * @param CreateFcOrderRequest $request
     * @return JsonResponse
     */
    public function store(CreateFcOrderRequest $request): JsonResponse
    {
        $data = $request->validated();
        $fcOrder = FcOrder::create($data);
        return $this->respondOk(new FcOrderResource ($fcOrder));
    }

    /**
     * Display the specified resource.
     *
     * @param FcOrder $fcOrder
     * @return JsonResponse
     */
    public function show(FcOrder $fcOrder): JsonResponse
    {
        return $this->respondOk(new FcOrderResource($fcOrder));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FcOrder $factoryRequest
     * @return Response
     */
    public function edit(FcOrder $factoryRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFcOrderRequest $request
     * @param FcOrder $fcOrder
     * @return JsonResponse
     */
    public function update(UpdateFcOrderRequest $request, FcOrder $fcOrder): JsonResponse
    {
        $data = $request->validated();
        $fcOrder->update($data);
        return $this->respondOk((new FcOrderResource($fcOrder)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FcOrder $fcOrder
     * @return JsonResponse
     */
    public function destroy(FcOrder $fcOrder): JsonResponse
    {
        $fcOrder->delete();
        $data=[
            'message'=>'Factoring Order has been deleted.'
        ];
        return $this->respondOk($data);
    }
}
