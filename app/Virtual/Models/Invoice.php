<?php

namespace App\Virtual\Models;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @OA\Schema(
 *     title="Invoice",
 *     description="Invoice Model",
 *     @OA\Xml(
 *         name="Invoice"
 *     )
 * )
 */
class Invoice
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="UUID",
     *     description="UUID",
     *     example="94f00347-6465-41e0-806e-801ddca16bda"
     * )
     *
     * @var string
     */
    private $uuid;

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
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *     title="Deleted at",
     *     description="Deleted at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $deleted_at;



}
