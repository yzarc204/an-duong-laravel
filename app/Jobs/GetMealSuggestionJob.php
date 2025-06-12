<?php

namespace App\Jobs;

use App\Classes\MyAI;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GetMealSuggestionJob implements ShouldQueue
{
    use Queueable;

    protected User $user;

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
        $suggestions = $myAI->askForMealSuggestion();
        if (count($suggestions)) {
            $this->user->meal_suggestions = $suggestions;
            $this->user->save();
        }
    }
}
