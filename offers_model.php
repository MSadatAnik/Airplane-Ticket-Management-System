<?php
// models/Offers.php

class Offers {
    private $couponNo;
    private $discount;
    private $validFrom;
    private $validTo;
    private $status;
    private $description;

    // Getters and setters
    public function getCouponNo() {
        return $this->couponNo;
    }

    public function setCouponNo($couponNo) {
        $this->couponNo = $couponNo;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function getValidFrom() {
        return $this->validFrom;
    }

    public function setValidFrom($date) {
        $this->validFrom = $date;
    }

    public function getValidTo() {
        return $this->validTo;
    }

    public function setValidTo($date) {
        $this->validTo = $date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    // Additional methods
    public function getOffer() {
        return [
            'couponNo' => $this->couponNo,
            'discount' => $this->discount,
            'validFrom' => $this->validFrom,
            'validTo' => $this->validTo,
            'status' => $this->status,
            'description' => $this->description
        ];
    }

    public function setOffer($couponNo, $discount, $validFrom, $validTo, $status, $description) {
        $this->couponNo = $couponNo;
        $this->discount = $discount;
        $this->validFrom = $validFrom;
        $this->validTo = $validTo;
        $this->status = $status;
        $this->description = $description;
    }

    public function validateOffer() {
        $currentDate = new DateTime();
        $validFrom = new DateTime($this->validFrom);
        $validTo = new DateTime($this->validTo);
        return $currentDate >= $validFrom && $currentDate <= $validTo;
    }
}
?>
