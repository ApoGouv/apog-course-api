<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     schema="Course",
 *     title="Course",
 *     description="Course model",
 *     @OA\Xml(
 *         name="Course"
 *     )
 * )
 */
class Course
{

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the course",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the course",
     *      example="Learn OpenAPI documentation"
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

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2024-01-27 10:05:35",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;
}