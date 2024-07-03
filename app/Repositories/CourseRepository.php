<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CourseRepository implements CourseRepositoryInterface
{

    protected $model;

    /**
     * CourseRepository constructor.
     *
     * @param Course $model
     */
    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    /**
     * Get a collection of all courses.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model->all();
    }

     /**
     * Find a course by its ID.
     *
     * @param  int  $id
     * @return Course|null
     */
    public function find(int $id): ?Course
    {
        return $this->model->find($id);
    }

    /**
     * Get the specified course.
     *
     * @param  int  $id
     * @return Course
     * @throws ModelNotFoundException
     */
    public function show(int $id): Course
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Store a new course.
     *
     * @param  array  $data
     * @return Course
     */
    public function store(array $data): Course
    {
        $course = $this->model->create($data);

        // Refresh the instance to get the latest data from the database
        // This will address the null value on created_at property of Course model.
        $course->refresh();
        return $course;
    }

    /**
     * Update an existing course.
     *
     * @param  int  $id
     * @param  array  $data
     * @return Course
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): Course
    {
        $course = $this->model->findOrFail($id);
        $course->update($data);
        return $course;
    }

    /**
     * Delete a course by its ID.
     *
     * @param  int  $id
     * @return void
     * @throws ModelNotFoundException|\Exception
     */
    public function delete(int $id): void
    {
        $course = $this->model->find($id);

        if (!$course) {
            throw new ModelNotFoundException("Course with ID {$id} not found.");
        }

        $deletedCount = $this->model->destroy($id);

        if ($deletedCount === 0) {
            throw new \Exception("Failed to delete course with ID {$id}: No records were deleted.");
        }
    }
}
