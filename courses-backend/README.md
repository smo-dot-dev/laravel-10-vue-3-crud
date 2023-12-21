<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Courses API

This is a RESTful API for managing courses, made with Laravel 10, PHP 8.2, and MySQL, all bundled in a Laravel Sail docker image.
  
* These are the endpoints:
  * Get a list of all courses.
    * GET /api/courses
  * Get details of a specific course.
    * GET /api/courses/id
  * Create a new course.
    * POST /api/courses
  * Update an existing course.
    * PUT /courses/id
  * Delete a course.
    * DELETE /courses/id



## Setup

To get this project running you will need:

- Composer
- Docker & Docker compose (or Docker Desktop)
- PHP >= 8.1


After cloning this repo, you must run `composer install` inside this directory, and after that you will be able to run the docker image:

```
    docker context use default
    ./vendor/bin/sail up
```

And don't forget to create your .env file based on the provided `.env.example`:

```
    cp .env.example .env
```

After the project is running on your [localhost](http://localhost), you will need to migrate and seed the DB, this will let you have the needed tables and some example courses:

```
    sail php artisan migrate
    sail php artisan db:seed --class=CourseSeeder
```

## Integration Tests

The test suite includes a total of 5 tests, they can be run by using:

`sail php artisan test --testsuite=Feature --stop-on-failure`

These are integration tests, the first one checks the API is running and the other four test each API endpoint returning the correct JSON structure and HTTP response.

Output looks something like this:

```
   PASS  Tests\Feature\ApiRunningTest
  ✓ api running 200 ok                                                                                        0.18s  

   PASS  Tests\Feature\CreateCourseTest
  ✓ create course                                                                                             1.77s  

   PASS  Tests\Feature\DeleteCourseTest
  ✓ delete course                                                                                             0.04s  

   PASS  Tests\Feature\ListCoursesTest
  ✓ list courses json structure                                                                               0.05s  

   PASS  Tests\Feature\UpdateCourseTest
  ✓ update course title                                                                                       0.04s  

  Tests:    5 passed (175 assertions)
  Duration: 2.17s
```


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
