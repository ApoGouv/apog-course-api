<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     schema="CourseFull",
 *     title="Course Full",
 *     description="Course model with all properties",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/Course"),
 *         @OA\Schema(
 *             @OA\Property(
 *                 property="deleted_at",
 *                 description="Deleted at",
 *                 example="2024-07-01 06:50:45",
 *                 format="datetime",
 *                 type="string"
 *             )
 *         )
 *     }
 * )
 */
class CourseFull
{
    // For OpenAPI documentation purposes only.
}
