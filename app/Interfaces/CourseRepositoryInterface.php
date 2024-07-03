<?php

namespace App\Interfaces;

interface CourseRepositoryInterface
{
    /**
     * Retrieve all courses.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index(): \Illuminate\Support\Collection;

    /**
     * Find a course by ID.
     *
     * @param  int  $id
     * @return \App\Models\Course|null
     */
    public function find(int $id): ?\App\Models\Course;

    /**
     * Show a course by ID.
     *
     * @param  int  $id
     * @return \App\Models\Course
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function show(int $id): \App\Models\Course;

    /**
     * Store a new course.
     *
     * @param  array  $data
     * @return \App\Models\Course
     */
    public function store(array $data): \App\Models\Course;

    /**
     * Update a course by ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \App\Models\Course
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, array $data): \App\Models\Course;

    /**
     * Remove the specified course from storage.
     *
     * @param  int  $id
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function delete(int $id): void;
}
