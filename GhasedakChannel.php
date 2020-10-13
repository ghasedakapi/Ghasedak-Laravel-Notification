<?php

namespace Ghasedak\LaravelNotification;

use Illuminate\Notifications\Notification;
use Ghasedak\GhasedakApi;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GhasedakChannel
{
    /**
     * @var GhasedakApi
     */
    protected $api;

    /**
     * @param GhasedakApi $api
     */
    public function __construct()
    {
        $api_key = config('services.ghasedak.api_key');
        $api = new GhasedakApi($api_key);
        $this->api = $api;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $sms = $notification->toSms($notifiable);
        if (is_string($sms)) {
            $sms = (new GhasedakSimpleSms($sms))->linenumber(config('services.ghasedak.linenumber'));
        }
        $receptor = $notifiable->receptor ? $notifiable->receptor : method_exists($notifiable,'routeNotificationForSms') ? $notifiable->routeNotificationForSms() : $notifiable->phone;
        $sms->receptor($receptor);

        if ($sms instanceof GhasedakSimpleSms) {

            $linenumber = $sms->data['linenumber'] ?? null;
            return $this->api->SendSimple($receptor, $sms->data['message'], $linenumber);

        } elseif ($sms instanceof GhasedakOTPSms) {
            $data = $sms->data;
            $param1 = $data['param1'];
            $param2 = $data['param2'] ?? null;
            $param3 = $data['param3'] ?? null;
            $param4 = $data['param4'] ?? null;
            $param5 = $data['param5'] ?? null;
            $param6 = $data['param6'] ?? null;
            $param7 = $data['param7'] ?? null;
            $param8 = $data['param8'] ?? null;
            $param9 = $data['param9'] ?? null;
            $param10 = $data['param10'] ?? null;
            return $this->api->Verify($receptor, $data['type'], $data['template'], $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8, $param9, $param10);
        }

    }
}
