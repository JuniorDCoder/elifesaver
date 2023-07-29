<?php
class PushNotification {
    private $serverKey = 'AAAAtL0Tib8:APA91bHBd-HAbW_UL0XgbxGPbCRkgJaNnRXL98_DzhUztVTo9EAd48KwlNmSMM8oKdB5t6x6etrzLKcVckQivr4wnmTv0QLKHfHQmmRwsTzP0ldv7VdGpWuYLMQkCVh1F3nETFQzCFS3';

    public function sendNotification($tokens, $message) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Authorization: key=' . $this->serverKey,
            'Content-Type: application/json'
        );

        $data = array(
            'registration_ids' => $tokens,
            'notification' => $message,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}