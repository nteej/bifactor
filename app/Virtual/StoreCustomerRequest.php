<?php

namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Store Customer request",
 *      description="Store Customer request body data",
 *      type="object",
 *      required={"name","contact","email"}
 * )
 */
class StoreCustomerRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new customer",
     *      example="DBL customer"
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
