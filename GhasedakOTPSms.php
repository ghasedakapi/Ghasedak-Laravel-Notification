<?php

namespace Ghasedak\LaravelNotification;

use Ghasedak\LaravelNotification\Exceptions\ExceptionFactory;

class GhasedakOTPSms extends GhasedakSms
{
    /**
     * @param  string $template
     * @return self
     */
    public function template($template)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $template);
        $this->data['template'] = $template;

        return $this;
    }
    /**
     * @param  integer $type
     * @return self
     */
    public function type($type)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'integer', $type);
        $this->data['type'] = $type;

        return $this;
    }
    /**
     * @param  string $checkid
     * @return self
     */
    public function checkid($checkid)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $checkid);
        $this->data['checkid'] = $checkid;

        return $this;
    }

    /**
     * @param  string $params
     * @return self
     */
    public function params($params)
    {
        if (count($params) > 10 || count($params) == 0) {
            throw new ApiException('Number of parameters exceeds maximum of 10', '409');
        }

        foreach ($params as $key => $param) {
            $params['param' . ($key + 1)] = $param;
            ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param);
            $this->data['param' . ($key + 1)] = $param;
        }

        return $this;
    }

    /**
     * @param  string $param1
     * @return self
     */
    public function param1($param1)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param1);
        $this->data['param1'] = $param1;

        return $this;
    }

    /**
     * @param  string $param2
     * @return self
     */
    public function param2($param2)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param2);
        $this->data['param2'] = $param2;

        return $this;
    }

    /**
     * @param  string $param3
     * @return self
     */
    public function param3($param3)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param3);
        $this->data['param3'] = $param3;

        return $this;
    }

    /**
     * @param  string $param4
     * @return self
     */
    public function param4($param4)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param4);
        $this->data['param4'] = $param4;

        return $this;
    }

    /**
     * @param  string $param5
     * @return self
     */
    public function param5($param5)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param5);
        $this->data['param5'] = $param5;

        return $this;
    }

    /**
     * @param  string $param6
     * @return self
     */
    public function param6($param6)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param6);
        $this->data['param6'] = $param6;

        return $this;
    }
    /**
     * @param  string $param7
     * @return self
     */
    public function param7($param7)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param7);
        $this->data['param7'] = $param7;

        return $this;
    }

    /**
     * @param  string $param8
     * @return self
     */
    public function param8($param8)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param8);
        $this->data['param8'] = $param8;

        return $this;
    }
    /**
     * @param  string $param9
     * @return self
     */
    public function param9($param9)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param9);
        $this->data['param9'] = $param9;

        return $this;
    }
    /**
     * @param  string $param10
     * @return self
     */
    public function param10($param10)
    {
        ExceptionFactory::assertArgumentType(1, __METHOD__, 'string', $param10);
        $this->data['param10'] = $param10;

        return $this;
    }
}
