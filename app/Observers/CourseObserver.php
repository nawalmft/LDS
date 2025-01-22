<?php

namespace App\Observers;

use App\Models\Course;
use Filament\Notifications\Notification;

class CourseObserver
{
    public function created(Course $course)
    {
        dd($course);
        $user = auth()->user();
        Notification::make()
            ->title('New course created')
            ->sendToDatabase($user->id);
    }

    public function updated(Course $course)
    {
        dd($course);
        Notification::make()
            ->title('Course Updated')
            ->success()
            ->send();
    }
}
