<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
    use HandlesAuthorization;

    public function published(?User $user, Job $job)
    {
        if ($job->status == true) {
            return true;
        } else {
            return false;
        }
    }
}
