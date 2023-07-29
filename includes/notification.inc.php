<?php
include('../classes/notification.class.php');
include('../classes/donor.class.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['blood_group'])) {
    $blood_group = $_GET['blood_group'];
    $donors = Donor::getDonorsByBloodGroup($blood_group);

    $tokens = array();
    foreach ($donors as $donor) {
        if ($donor->device_token) {
            array_push($tokens, $donor->device_token);
        }
    }

    // Send push notifications to the device tokens
    $title = 'Blood Donation Request';
    $message = 'There is a blood donation request for '.$blood_group.' blood type. Can you donate?';
    $push_notification = new PushNotification();
    $push_notification->sendPushNotification($tokens, $title, $message);
}