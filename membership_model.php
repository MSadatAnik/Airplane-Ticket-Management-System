<?php
// models/Membership.php

class Membership {
    private $membershipId;
    private $tier;
    private $startDate;
    private $endDate;
    private $status;

    // Getters and setters
    public function getId() {
        return $this->membershipId;
    }

    public function setId($id) {
        $this->membershipId = $id;
    }

    public function getTier() {
        return $this->tier;
    }

    public function setTier($tier) {
        $this->tier = $tier;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate($date) {
        $this->startDate = $date;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate($date) {
        $this->endDate = $date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Additional methods
    public function getMembership() {
        return [
            'membershipId' => $this->membershipId,
            'tier' => $this->tier,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'status' => $this->status
        ];
    }

    public function cancelMembership() {
        $this->status = 'Cancelled';
    }

    public function renewMembership() {
        // Implementation for renewing membership
    }

    public function upgradeTier($newTier) {
        $this->tier = $newTier;
    }
}
?>
