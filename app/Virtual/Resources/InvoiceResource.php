<?php

namespace App\Virtual\Resources;
/**
 * @OA\Schema(
 *     title="Invoice Resource",
 *     description="Invoice Resource",
 *     @OA\Xml(
 *         name="InvoiceResource"
 *     )
 * )
 */
class InvoiceResource
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
     *          description="Invoice Data"
     *      )
     * )
     * @var \App\Virtual\Models\Invoice[]
     */
    private $data;
}
