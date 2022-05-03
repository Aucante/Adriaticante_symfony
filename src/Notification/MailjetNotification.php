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

    public function send($emailTo,
                         $nameTo,
                         $templateId,
                         $subject,
                         $var1,
                         $var2,
                         $var3,
                         $var4,
                         $var5
                         ) {

        $mj = new Client($this->apikey, $this->apisecret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'no-reply@adriaticante.com',
                        'Name' => 'Adriaticante'
                    ],
                    'To' => [
                        [
                            'Email' => $emailTo,
                            'Name' => $nameTo
                        ]
                    ],
                    'TemplateID' => $templateId,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'variables' => [
                        'var1' => $var1,
                        'var2' => $var2,
                        'var3' => $var3,
                        'var4' => $var4,
                        'var5' => $var5,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }

}

?>