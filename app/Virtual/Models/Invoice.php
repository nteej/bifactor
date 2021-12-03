<?php

namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Customer",
 *     description="Customer model",
 *     @OA\Xml(
 *         name="Customer"
 *     )
 * )
 */
class Customer
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
     *      title="Name",
     *      description="Name of the new Customer",
     *      example="Creditor name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Contact",
     *      description="Contact of the new Customer",
     *      example="This is new company's contact details"
     * )
     *
     * @var string
     */
    public $contact;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email Address of the new Customer",
     *      example="This is new company's email address details"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Info",
     *      description="Additional Info",
     *      example="'info':{'address':'colombo'}"
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
