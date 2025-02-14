<?php

namespace App\Policies;

use App\Models\EnrollmentRequest;
use App\Models\User;
use App\Models\Trainee;
use Illuminate\Auth\Access\Response;

class EnrollmentRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EnrollmentRequest $enrollmentRequest,Trainee $trainee): bool
    {
        return $user->isAdmin()|| $trainee->isTrainee();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Trainee $trainee): bool

    {
        return $user->isAdmin()|| $trainee->isTrainee();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EnrollmentRequest $enrollmentRequest,Trainee $trainee): bool
    {
        return $user->isAdmin()|| $trainee->isTrainee();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EnrollmentRequest $enrollmentRequest,Trainee $trainee): bool
    {
        return $user->isAdmin()|| $trainee->isTrainee();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EnrollmentRequest $enrollmentRequest): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EnrollmentRequest $enrollmentRequest): bool
    {
        return $user->isAdmin();
    }
}
