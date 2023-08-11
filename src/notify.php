<?php
include '../classes/db_connect.class.php';
$conn = Database::getInstance()->getConn();
// Get the registration tokens of donors with the specified blood group
$blood_group = 'O+';
$stmt = $conn->prepare("SELECT registration_token FROM donors WHERE blood_group = ?");
$stmt->bind_param("s", $blood_group);
$stmt->execute();
$result = $stmt->get_result();
$registration_tokens = array();
while ($row = $result->fetch_assoc()) {
  array_push($registration_tokens, $row['registration_token']);
}

// Send a notification to each donor with the specified blood group
$url = 'https://fcm.googleapis.com/fcm/send';
$headers = array(
  'Authorization: key=AAAAtL0Tib8:APA91bHBd-HAbW_UL0XgbxGPbCRkgJaNnRXL98_DzhUztVTo9EAd48KwlNmSMM8oKdB5t6x6etrzLKcVckQivr4wnmTv0QLKHfHQmmRwsTzP0ldv7VdGpWuYLMQkCVh1F3nETFQzCFS3',
  'Content-Type: application/json'
);
$data = array(
  'notification' => array(
    'title' => 'Blood donation needed',
    'body' => 'There is a blood donation request for ' . $blood_group . ' blood group.'
  ),
  'registration_ids' => $registration_tokens
);
$options = array(
  'http' => array(
    'header'  => $headers,
    'method'  => 'POST',
    'content' => json_encode($data)
  )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo $result;
if ($result === false) {
  echo 'Error sending notification.';
} else {
  echo 'Notification sent.';
}