<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Store Invoice request",
 *      description="Store Invoice request body data",
 *      type="object",
 *      required={"invoice_no","due_date","customer_id","company_id","total_amount,"state"},
 * )
 */
class StoreInvoiceRequest
{
    /**
     * @OA\Property(
     *      title="Invoice No"
     * )
     *
     * @var integer
     */
    public $invoice_no;
    /**
     * @OA\Property(
     *      title="Due Date"
     * )
     *
     * @var \Date
     */
    public $due_date;/**
 * @OA\Property(
 *      title="Customer Id"
 * )
 *
 * @var integer
 */
    public $customer_id;/**
 * @OA\Property(
 *      title="Company Id"
 * )
 *
 * @var integer
 */
    public $company_id;

    /**
     * @OA\Property(
     *      title="Total Amount"
     * )
     *
     * @var \float
     */
    public $total_amount;

    /**
     * @OA\Property(
     *      title="Info",
     *      description="Additional Info",
     *      example="'info':{'item-1':340}"
     * )
     *
     * @var object
     */
    public $info;
    /**
     * @OA\Property(
     *      title="Status",
     *      description="Is active or not",
     *      example=false
     * )
     *
     * @var boolean
     */
    public $status;
}
