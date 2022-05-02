<?php

namespace App\Notification;
/*
This call sends a message based on a template.
*/

use Mailjet\Client;
use \Mailjet\Resources;

class MailjetNotification
{

    private $apikey = "e0feab9c252926313e402845d34b41bd";
    private $apisecret = "2755614c9a0b3a04fdcc52de5cfe4148";

    public function send($emailTo, $name, $subject, $content) {

        $mj = new Client($this->apikey, $this->apisecret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "adriaticante.pro@gmail.com",
                        'Name' => "Adriaticante"
                    ],
                    'To' => [
                        [
                            'Email' => $emailTo,
                            'Name' => $name
                        ]
                    ],
                    'TemplateID' => 3906499,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }

}

?>