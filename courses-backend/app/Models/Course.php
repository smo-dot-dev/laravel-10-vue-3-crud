<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'video_url', 'video_duration'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /* protected $casts = [
        'video_duration' => 'datetime:H:i:s',
    ]; */

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
