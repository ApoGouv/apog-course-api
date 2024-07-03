# Schoox - Interview Assignment - Project

## Intro

This is my implementation of the Shcoox interview assignment, implemented with Laravel 11 using a layered architecture, based on my research.

Tested on PHP 8.2.20

## Clone the Repository

First, clone the repository from GitHub to your local machine.

```sh
git clone https://github.com/ApoGouv/apog-course-api.git
cd apog-course-api
```

## Install Dependencies

Before setting up the database, make sure to install all necessary dependencies.

```sh
# Install PHP dependencies
composer install
```

## Setup Database

### 1. Modify DB_CONNECTION in .env 

By default `DB_CONNECTION` is set to "sqlite".
and there is a sample DB, with dummy data, located at: `database/database.sqlite`

In the `.env`, there are also commented variable entries for "mysql" connection and a DB named "assignment_data" (needs to be created).

> **Disclaimer**: For simplicity I intetionally included the `.env` and `database.sqlite` files, in order to facilitate faster project inspection.

### 2. Run migrations and Seeding

```sh
# Run migrations
php artisan migrate

# Seed our course table (defaults to 10 entries. You can modify it on Database\Seeders\CourseSeeder)
php artisan db:seed --class=CourseSeeder

# OR Start with fresh migration and seeding
php artisan migrate:refresh --seed
```

## Set Swagger HOST 

If your dev app runs on different domain than `http://127.0.0.1:8000`, you should modify the swagger HOST entry found in the `.env` file.

```sh
L5_SWAGGER_CONST_HOST='http://127.0.0.1:8000'
```

## Run with laravel's local development server:

```sh
cd apog-course-api

php artisan serve

```

Then you will see a message like: `Server running on [http://127.0.0.1:8000].`

## App Routes

| Method      | URI                            | Name                      | Action                                                            |
|-------------|--------------------------------|---------------------------|-------------------------------------------------------------------|
| GET         | api/v1/courses                 | courses.index             | Api\V1\CourseApiController@index                                  |
| POST        | api/v1/courses                 | courses.store             | Api\V1\CourseApiController@store                                  |
| GET         | api/v1/courses/{id}            | courses.show              | Api\V1\CourseApiController@show                                   |
| PUT         | api/v1/courses/{id}            | courses.update            | Api\V1\CourseApiController@update                                 |
| DELETE      | api/v1/courses/{id}            | courses.destroy           | Api\V1\CourseApiController@destroy                                |
| GET         | api/documentation              | l5-swagger.default.api    | L5Swagger\Http\SwaggerController@api                              |
| GET         | api/oauth2-callback            | l5-swagger.default.oauth2_callback | L5Swagger\Http\SwaggerController@oauth2Callback               |
| GET         | docs/asset/{asset}             | l5-swagger.default.asset  | L5Swagger\Http\SwaggerAssetController@index                       |
| GET         | docs/{jsonFile?}               | l5-swagger.default.docs   | L5Swagger\Http\SwaggerController@docs                             |
| GET         | up                             |                           |                                                                   |


## App Layers

### Controller Layer

- **Responsibility**: Handles HTTP requests, validates incoming data to ensure it meets required criteria before passing it to the business logic layer.
- **Main Classes/Interfaces**:
  - `CourseApiController`: Main API handler controller responsible for managing course resources.
  - `CourseResource`: Resource class for transforming course data into JSON responses.
  - Request Classes for validation:
    - `BaseCourseRequest`: Abstract base class for course-related requests.
    - `DestroyCourseRequest`: Request class for handling course deletion requests.
    - `ShowCourseRequest`: Request class for handling course retrieval requests.
    - `StoreCourseRequest`: Request class for handling course creation requests.
    - `UpdateCourseRequest`: Request class for handling course update requests.


### Business Logic Layer (Service Layer)

- **Responsibility**: Contains core business logic, processes data, and interacts with the data access layer.
- **Main Classes/Interfaces**:
  - `CourseServiceInterface`: Interface defining methods for the course service layer.
  - `CourseService`: Service class implementing business logic for course-related operations.

### Data Access Layer (Repository Layer)

- **Responsibility**: Directly interacts with the database, providing an abstraction over data operations.
- **Main Classes/Interfaces**:
  - `CourseRepositoryInterface`: Interface defining methods for the course repository layer.
  - `CourseRepository`: Repository class handling database operations for courses.
  - `Course`: Model representing a course in the application.


## Courses OpenAPI/Swagger Documentation

Visit `/api/documentation#/Courses`

e.g. [http://127.0.0.1:8000/api/documentation#/Courses](http://127.0.0.1:8000/api/documentation#/Courses)