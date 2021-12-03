<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Update Company request",
 *      description="Store Company request body data",
 *      type="object",
 *      required={"name","contact","email","debtor_limit"}
 * )
 */
class UpdateInvoiceRequest
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
