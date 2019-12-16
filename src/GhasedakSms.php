<?php

namespace Ghasedak\LaravelNotification;


use Ghasedak\LaravelNotification\Exceptions\ExceptionFactory;

abstract class GhasedakSms
{
    /**
     * @internal
     * @var array
     */
    public $data = [];
    /**
     * @param  string||array $receptor
     * @return self
     */
    public function receptor($receptor)
    {
//        ExceptionFactory::assertArgumentType(1, __METHOD__, ['string','Null'], $receptor);
        $this->data['receptor'] = $receptor;

        return $this;
    }
}
