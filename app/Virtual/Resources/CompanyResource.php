<?php

namespace App\Virtual\Resources;
/**
 * @OA\Schema(
 *     title="Company Resource",
 *     description="Comapny resource",
 *     @OA\Xml(
 *         name="CompanyResource"
 *     )
 * )
 */
class CompanyResource
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
     *          description="Company Data"
     *      )
     * )
     * @var \App\Virtual\Models\Company[]
     */
    private $data;
}
