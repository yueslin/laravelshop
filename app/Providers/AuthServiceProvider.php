<?php

namespace App\Providers;

use App\Models\Installment;
use App\Models\InstallmentItem;
use App\Models\UserAddress;
use App\Policies\InstallmentPolicy;
use App\Policies\UserAddressPolicy;use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Order;
use App\Policies\OrderPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        UserAddress::class => UserAddressPolicy::class,
        Order::class       => OrderPolicy::class,
        Installment::class => InstallmentPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
