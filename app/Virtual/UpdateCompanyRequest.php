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
class UpdateCompanyRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new comapny",
     *      example="Darly Butley & company"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="contact",
     *      description="Contact of the new comapny",
     *      example="+9477869772"
     * )
     *
     * @var string
     */
    public $contact;

    /**
     * @OA\Property(
     *      title="email",
     *      description="Email address of the new comapny",
     *      example="comapny@gmail.com"
     * )
     *
     * @var string
     */
    public $email;
    /**
     * @OA\Property(
     *      title="info",
     *      description="info of the new comapny",
     * )
     *
     * @var object
     */

    public $info;
    /**
     * @OA\Property(
     *      title="Debtor Limit",
     *      description="Debtor limit of the new comapny",
     *      format="int64",
     *      example=10000
     * )
     *
     * @var integer
     */
    public $debtor_limit;
}
