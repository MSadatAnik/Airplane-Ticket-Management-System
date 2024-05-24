<?php
// views/offer_view.php

function displayOffer($offer) {
    echo "<h1>Offer Details</h1>";
    echo "Coupon No: " . $offer['couponNo'] . "<br>";
    echo "Discount: " . $offer['discount'] . "%<br>";
    echo "Valid From: " . $offer['validFrom'] . "<br>";
    echo "Valid To: " . $offer['validTo'] . "<br>";
    echo "Status: " . $offer['status'] . "<br>";
    echo "Description: " . $offer['description'] . "<br>";
}
?>
