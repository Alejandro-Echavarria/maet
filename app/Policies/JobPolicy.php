<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function published(?User $user, Job $job)
    {
        if ($job->status == true) {
            return true;
        } else {
            return false;
        }
    }
}
