<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Testimonial $testimonial)
    {
        return $user->id === $testimonial->user_id;
    }

    public function delete(User $user, Testimonial $testimonial)
    {
        return $user->id === $testimonial->user_id;
    }
}
