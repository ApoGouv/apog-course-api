<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Requests\BaseCourseRequest;
use App\Http\Requests\ShowCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\DestroyCourseRequest;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Courses API Documentation",
 *      version="1.0.0",
 *      description="Documentation for courses REST API",
 * )
 */
class CourseApiController extends Controller
{

    protected $courseService;

    /**
     * CourseController constructor.
     *
     * @param CourseService $model
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * @OA\Get(
     *      path="/courses",
     *      operationId="getCoursesList",
     *      tags={"courses"},
     *      summary="Get list of courses",
     *      description="Returns list of courses",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *       )
     * )
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CourseResource::collection($this->courseService->getCoursesList());
    }

    /**
     * @OA\Get(
     *      path="/courses/{id}",
     *      operationId="getCourseById",
     *      tags={"courses"},
     *      summary="Get course information by ID",
     *      description="Returns course data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Course not found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Failed to retrieve course"
     *      )
     * )
     * 
     * Display the specified course.
     *
     * @param  ShowCourseRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ShowCourseRequest $request)
    {
        try {
            $course = $this->courseService->getCourseById($request->validated('id'));
            return new CourseResource($course);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Course not found',
                'errors' => [
                    [
                        'resource' => BaseCourseRequest::RESOURCE_NAME,
                        'field' => 'id',
                        'code' => BaseCourseRequest::NOT_FOUND_ERROR_CODE,
                        'message' => 'The specified course does not exist.'
                    ]
                ]
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to retrieve course',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *      path="/courses",
     *      operationId="storeCourse",
     *      tags={"courses"},
     *      summary="Store new course",
     *      description="Returns course data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCourseRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Course created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Failed to store course"
     *      )
     * )
     * 
     * Store a newly created resource in storage.
     *
     * @param  StoreCourseRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            $course = $this->courseService->storeCourse($request->validated());
            return (new CourseResource($course))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to store course',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Put(
     *      path="/courses/{id}",
     *      operationId="updateCourse",
     *      tags={"courses"},
     *      summary="Update existing course",
     *      description="Returns updated course data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCourseRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Course updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Course not found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Failed to update course"
     *      )
     * )
     * 
     * Update the specified resource in storage.
     *
     * @param  UpdateCourseRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(UpdateCourseRequest $request)
    {
        try {
            $course = $this->courseService->updateCourse($request->validated());

             // Return a JSON response with the updated course data
            return (new CourseResource($course))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Course not found',
                'errors' => [
                    [
                        'resource' => BaseCourseRequest::RESOURCE_NAME,
                        'field' => 'id',
                        'code' => BaseCourseRequest::NOT_FOUND_ERROR_CODE,
                        'message' => 'The specified course does not exist.'
                    ]
                ]
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            // Handle other unexpected errors
            return response()->json([
                'message' => 'Failed to update course',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Delete(
     *      path="/courses/{id}",
     *      operationId="deleteCourse",
     *      tags={"courses"},
     *      summary="Delete existing course",
     *      description="Soft deletes a course record",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Course deleted successfully"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Course not found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Failed to delete course"
     *      )
     * )
     * 
     * Remove the specified resource from storage.
     *
     * @param  DestroyCourseRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyCourseRequest $request)
    {
        try {
            $this->courseService->deleteCourse($request->validated('id'));
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Course not found',
                'errors' => [
                    [
                        'resource' => BaseCourseRequest::RESOURCE_NAME,
                        'field' => 'id',
                        'code' => BaseCourseRequest::NOT_FOUND_ERROR_CODE,
                        'message' => 'The specified course does not exist.'
                    ]
                ]
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to delete course',
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
