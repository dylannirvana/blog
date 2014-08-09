<?php

class Mailchimp_Neapolitan {
    public function __construct(MCAPI2_Mailchimp $master) {
        $this->master = $master;
    }

}