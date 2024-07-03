<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Course request",
 *      description="Store Course request body data",
 *      type="object",
 *      required={"title", "description", "status", "is_premium"}
 * )
 */
class StoreCourseRequest
{

    /**
     * @OA\Property(
     *      title="title",
     *      description="Title of the new course",
     *      example="Learn OpenAPI documentation part 1"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the course",
     *      example="This is the course's description blah blah blah"
     * )
     *
     * @var string
     */
    public $description;
    /**
     * @OA\Property(
     *      title="Status",
     *      description="Status of the course",
     *      example="Pending",
     *      type="string",
     *      enum={App\Enums\CourseStatusEnum::class}
     * )
     *
     * @var string
     */
    public $status;

    /**
     * @OA\Property(
     *      title="Is premium",
     *      description="Set if course is premium",
     *      example=1,
     *      type="boolean"
     * )
     *
     * @var boolean
     */
    public $is_premium;
}