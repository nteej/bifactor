<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Update Customer request",
 *      description="Update Customer request body data",
 *      type="object",
 *      required={"name","contact","email"}
 * )
 */
class UpdateCustomerRequest
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
     *     example=1
     * )
     *
     * @var string
     */
    private $uuid;
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new customer",
     *      example="Darly Butley & customer"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="contact",
     *      description="Contact of the new customer",
     *      example="+9477869772"
     * )
     *
     * @var string
     */
    public $contact;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email address of the new customer",
     *      example="customer@gmail.com"
     * )
     *
     * @var string
     */
    public $email;
    /**
     * @OA\Property(
     *      title="info",
     *      description="info of the new customer",
     * )
     *
     * @var object
     */

    public $info;

}
