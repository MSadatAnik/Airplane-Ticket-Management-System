<?php
// views/membership_view.php

function displayMembership($membership) {
    echo "<h1>Membership Details</h1>";
    echo "ID: " . $membership['membershipId'] . "<br>";
    echo "Tier: " . $membership['tier'] . "<br>";
    echo "Start Date: " . $membership['startDate'] . "<br>";
    echo "End Date: " . $membership['endDate'] . "<br>";
    echo "Status: " . $membership['status'] . "<br>";
}
?>
