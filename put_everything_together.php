<?php
// index.php

    require_once 'controllers/MembershipController.php';
    require_once 'controllers/OffersController.php';
    require_once 'views/membership_view.php';
    require_once 'views/offer_view.php';
    
    // Example to display membership details
    $membershipController = new MembershipController();
    $membership = $membershipController->getMembership('M12345');
    displayMembership($membership);
    
    // Example to display offer details
    $offersController = new OffersController();
    $offer = $offersController->getOffer('C123');
    displayOffer($offer);
?>