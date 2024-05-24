<?php
// controllers/MembershipController.php

require_once 'models/Membership.php';

class MembershipController {
    public function getMembership($id) {
        // Fetch membership data from the database (example code)
        $membership = new Membership();
        $membership->setId($id);
        $membership->setTier('Gold');
        $membership->setStartDate('2023-01-01');
        $membership->setEndDate('2024-01-01');
        $membership->setStatus('Active');

        return $membership->getMembership();
    }

    public function cancelMembership($id) {
        // Example code to cancel membership
        $membership = new Membership();
        $membership->setId($id);
        $membership->cancelMembership();
    }

    public function renewMembership($id) {
        // Example code to renew membership
        $membership = new Membership();
        $membership->setId($id);
        $membership->renewMembership();
    }

    public function upgradeTier($id, $newTier) {
        // Example code to upgrade tier
        $membership = new Membership();
        $membership->setId($id);
        $membership->upgradeTier($newTier);
    }
}
?>
