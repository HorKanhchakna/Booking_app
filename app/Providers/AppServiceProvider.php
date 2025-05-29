<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Testimonial;
use App\Policies\TestimonialPolicy;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Package;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Testimonial::class => TestimonialPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */


public function boot()
{
    View::composer('*', function ($view) {
        $packages = collect();
        if (Auth::check()) {
            $userId = Auth::id();
            $bookedPackageIds = Booking::where('user_id', $userId)->pluck('package_id')->unique();
            $packages = Package::whereIn('id', $bookedPackageIds)->get();
        }
        $view->with('packages', $packages);
    });
}

}
