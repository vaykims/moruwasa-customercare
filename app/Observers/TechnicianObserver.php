<?php

namespace App\Observers;

use App\Technician;

class TechnicianObserver
{
    /**
     * Handle the Technician "created" event.
     *
     * @param  \App\Technician  $technician
     * @return void
     */
    public function creating(Technician $technician)
    {
        $technician->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

    public function created(Technician $technician)
    {
        //
    }

    /**
     * Handle the Technician "updated" event.
     *
     * @param  \App\Technician  $technician
     * @return void
     */
    public function updated(Technician $technician)
    {
        //
    }

    /**
     * Handle the Technician "deleted" event.
     *
     * @param  \App\Technician  $technician
     * @return void
     */
    public function deleted(Technician $technician)
    {
        //
    }
}