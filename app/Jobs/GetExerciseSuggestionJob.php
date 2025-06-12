<?php

namespace App\Jobs;

use App\Classes\MyAI;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GetExerciseSuggestionJob implements ShouldQueue
{
    use Queueable;

    private User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $myAI = new MyAI($this->user);
        $exercises = $myAI->askForExerciseSuggestion();
        if (count($exercises)) {
            $this->user->exercise_suggestions = $exercises;
            $this->user->save();
        }
    }
}
