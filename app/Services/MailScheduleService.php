<?php

namespace App\Services;

use App\Http\Controllers\MailingController;

class MailScheduleService
{
    public function mailing()
    {
        $mailing = new MailingController();
        return $mailing->store();
    }
}
