<?php

namespace App\Virtual\Resources;
/**
 * @OA\Schema(
 *     title="Customer Resource",
 *     description="Customer Resource",
 *     @OA\Xml(
 *         name="CustomerResource"
 *     )
 * )
 */
class CustomerResource
{

    /**
     * @OA\Property(
     *          property="success",
     *          type="boolean"
     *      ),
     * @OA\Property(
     *          property="message",
     *          type="string"
     *      ),
     * @OA\Property(
     *     property="result",
     *     type="object",
     *      @OA\Property(
     *          title="Data",
     *          description="Customer Data"
     *      )
     * )
     * @var \App\Virtual\Models\Customer[]
     */
    private $data;
}
