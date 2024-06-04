<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function published(?User $user, Job $job)
    {
        if ($job->is_published == true || auth()->user()) {
            return true;
        } else {
            return false;
        }
    }
}
