<?php

class FastwaySms
{
    private $username;
    private $password;
    private $baseUrl = "https://fastway-sms.net/api/v1/sms";

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    private function getAuthKey()
    {
        return base64_encode($this->username . ':' . $this->password);
    }

    public function send($to, $text, $from = "SMS-FASTWAY")
    {
        $url = $this->baseUrl . "/send";
        $params = array(
            "from" => $from,
            "to" => $to,
            "text" => $text
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $this->getAuthKey()));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return array('status' => $status, 'response' => $result);
    }

    public function checkBalance()
    {
        $url = $this->baseUrl . "/balance";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $this->getAuthKey()));

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return array('status' => $status, 'response' => $result);
    }
}

