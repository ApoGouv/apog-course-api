<?php

namespace App\Interfaces;

interface CourseServiceInterface
{
    /**
     * Get a list of the courses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCoursesList(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Retrieve a specific course by its ID.
     *
     * @param  int  $id
     * @return \App\Models\Course
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getCourseById(int $id): \App\Models\Course;

    /**
     * Store a newly created course in storage.
     *
     * @param  array  $data
     * @return \App\Models\Course
     */
    public function storeCourse(array $data): \App\Models\Course;

    /**
     * Update the specified course in storage.
     *
     * @param  array  $data
     * @return \App\Models\Course
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function updateCourse(array $data): \App\Models\Course;

    /**
     * Remove the specified course from storage.
     *
     * @param  int  $id
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteCourse(int $id): void;
}
