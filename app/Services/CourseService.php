<?php

namespace App\Services;

use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\CourseServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Course;

class CourseService implements CourseServiceInterface
{
    protected $courseRepository;

    /**
     * CourseService constructor.
     *
     * @param CourseRepositoryInterface $courseRepository
     */
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    
    /**
     * Get a listing of all courses.
     *
     * @return Collection
     */
    public function getCoursesList(): Collection
    {
        return $this->courseRepository->index();
    }

    /**
     * Display the specified course.
     *
     * @param  int  $id
     * @return Course
     */
    public function getCourseById(int $id): Course
    {
        return $this->courseRepository->show($id);
    }

    /**
     * Store a new course.
     *
     * @param  array  $data
     * @return Course
     */
    public function storeCourse(array $data): Course
    {
        return $this->courseRepository->store($data);
    }

    /**
     * Update an existing course.
     *
     * @param  array  $data
     * @return Course
     */
    public function updateCourse(array $data): Course
    {
        $id = $data['id'];
        unset($data['id']);
        return $this->courseRepository->update($id, $data);
    }

    /**
     * Delete a course.
     *
     * @param  int  $id
     * @return void
     */
    public function deleteCourse(int $id): void
    {
        $this->courseRepository->delete($id);
    }
}