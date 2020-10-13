<?php

namespace Ghasedak\LaravelNotification;

use Ghasedak\LaravelNotification\Exceptions\ExceptionFactory;

class GhasedakSimpleSms extends GhasedakSms
{
    /**
     * @param string|null $content
     */
    public function __construct($message = null)
    {
        ExceptionFactory::assertArgumentTypes(1, __METHOD__, ['string', 'NULL'], $message);
        if ($message !== null) {
            $this->data['message'] = $message;
        }
    }

    /**
     * @param  string $message
     * @return self
     */
    public function message($message)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $message);
        $this->data['message'] = $message;

        return $this;
    }

    /**
     * @param  string $linenumber
     * @return self
     */
    public function linenumber($linenumber)
    {
        if (!is_null($linenumber)) {
            ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $linenumber);
        }
        $this->data['linenumber'] = $linenumber;

        return $this;
    }
    /**
     * @param  string $senddate
     * @return self
     */
    public function senddate($senddate)
    {
        if (!is_null($senddate)) {
            ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $senddate);
        }
        $this->data['senddate'] = $senddate;

        return $this;
    }

    /**
     * @param  string $checkid
     * @return self
     */
    public function checkid($checkid)
    {
        if (!is_null($checkid)) {
            ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $checkid);
        }
        $this->data['checkid'] = $checkid;

        return $this;
    }

}
