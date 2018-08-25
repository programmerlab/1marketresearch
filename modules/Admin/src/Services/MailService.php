<?php

declare(strict_types=1);

namespace Modules\Admin\Services;

use Illuminate\Mail\Mailer;
use Stevebauman\CoreHelper\Services\Service;
use Swift_TransportException;

/**
 * Class MailService.
 */
class MailService extends Service
{
    /**
     * @var Mailer
     */
    protected $mail;

    /**
     * Constructor.
     *
     * @param Mailer $mail
     */
    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Sends an email using laravel's mailer.
     *
     * @param array|string $views
     * @param mixed        $data
     * @param $callback
     *
     * @return bool
     */
    public function send($views, $data, $callback)
    {
        try {
            $this->mail->send($views, $data, $callback);

            return true;
        } catch (Swift_TransportException $e) {
            return false;
        }
    }
}
