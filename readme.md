## Objective
Implement a course editor application where users can create, update, and delete courses. The application should allow users to view a list of courses, add new courses, edit existing courses, and delete courses.

## Requirements

### Backend API
* Use Laravel 10 to create a RESTful API for managing courses.
* The API should have endpoints for the following operations:
  * Get a list of all courses.
  * Get details of a specific course.
  * Create a new course.
  * Update an existing course.
  * Delete a course.

### Frontend Application
* Use Vue.js to create a user interface for the course editor.
* Display a list of courses retrieved from the backend API.
* Provide a form to add a new course, including fields for title, description, video url, and video duration.
* Allow users to edit existing courses by clicking on a course in the list and updating its details in a form.
* Allow users to delete a course by clicking on a delete button next to each course in the list.

### Additional Tasks
* Use Laravel Sail to prepare a docker environment.
* Create some integration tests.
* Create a migration that adds a new field to your database.

## Notes
* All tests you have written need to pass when run.
