<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'course_id'];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    /* TODO: Seeder, Factory, and Tests */
    /*
        // Create a new course
        $course = App\Models\Course::create(['title' => 'Test, test', 'description' => 'This is nothing but a drill', 'video_url' => 'http://example.com', 'video_duration' => 4200]);

        // Create a new lesson and associate it with the course
        $lesson = App\Models\Lesson::create(['title' => 'And now, for something completely different...', 'content' => 'The Larch', 'course_id' => $course->id]);

        // Retrieve the course and its lessons
        $courseWithLessons = App\Models\Course::with('lessons')->find($course->id);

        // Retrieve the lesson and its course
        $lessonWithCourse = App\Models\Lesson::with('course')->find($lesson->id);


        $courseWithLessons = App\Models\Course::with('lessons')->find(34);
        $lessonWithCourse = App\Models\Lesson::with('course')->find(1);

    */
}
