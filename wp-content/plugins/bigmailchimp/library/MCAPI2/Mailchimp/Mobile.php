<?php

class Mailchimp_Mobile {
    public function __construct(MCAPI2_Mailchimp $master) {
        $this->master = $master;
    }

}