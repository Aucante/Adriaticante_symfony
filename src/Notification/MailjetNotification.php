<?php

namespace App\Notification;

/*
This call sends a message based on a template.
*/

use Mailjet\Client;
use Mailjet\Resources;

class MailjetNotification
{
    private Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

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
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'no-reply@adriaticante.com',
                        'Name' => 'Adriaticante',
                    ],
                    'To' => [
                        [
                            'Email' => $emailTo,
                            'Name' => $nameTo,
                        ],
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
                    ],
                ],
            ],
        ];
        $this->client->post(Resources::$Email, ['body' => $body]);
    }
}
