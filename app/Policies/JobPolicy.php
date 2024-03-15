<?php

namespace App\Policies;

use App\Models\Job;

class JobPolicy
{
    public function published($job)
    {
        if ($job->status) {
            return true;
        } else {
            return false;
        }
    }
}
