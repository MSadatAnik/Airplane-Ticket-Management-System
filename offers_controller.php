<?php
// controllers/OffersController.php

require_once 'models/Offers.php';

class OffersController {
    public function getOffer($couponNo) {
        // Fetch offer data from the database (example code)
        $offer = new Offers();
        $offer->setCouponNo($couponNo);
        $offer->setDiscount(20);
        $offer->setValidFrom('2023-06-01');
        $offer->setValidTo('2023-12-31');
        $offer->setStatus('Active');
        $offer->setDescription('20% off on all flights');

        return $offer->getOffer();
    }

    public function validateOffer($couponNo) {
        // Example code to validate offer
        $offer = new Offers();
        $offer->setCouponNo($couponNo);
        return $offer->validateOffer();
    }
}
?>
