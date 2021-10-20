<?php

namespace App\Observers;

use App\Models\Visitor;

class VisitorsObserver
{
    /**
     * Handle the notification "created" event.
     *
     * @param \App\General\Notification $notification
     * @return void
     */
    public function creating(Visitor $r)
    {
//        $this->notify_user($notification);

        $r->qr_code = strtoupper(uniqid($r->occasion_id));

    }



}
