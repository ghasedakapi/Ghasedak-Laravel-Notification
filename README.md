  
<!-- PROJECT LOGO -->    
<br />    
<p align="center">    
  <a href="https://github.com/ghasedakapi/Ghasedak-Laravel-Notification">  
    <img src="ghasedak-logo.png" alt="Logo" height="200" alt="ghasedak for php">    
  </a>    
    
  <h3 align="center">Ghasedak Laravel Notification</h3>    
    
  <p align="center">    
    Easy-to-use SDK for implementing Ghasedak SMS Notification in your Laravel projects.    
    <br />    
    <a href="#table-of-contents"><strong>Explore the docs »</strong></a>    
    <br />    
    <br />    
    <a href="https://ghasedak.io/developers">Web Service Documents</a>    
    ·    
    <a href="https://ghasedak.io/docs">REST API</a>    
    .    
    <a href="https://github.com/ghasedakapi/ghasedak-php/issues">Report Bug</a>    
    ·    
    <a href="https://github.com/ghasedakapi/ghasedak-php/issues">Request Feature</a>    
  </p>    
</p>
    
<br>    
<p align="center">  
   <a href="https://github.com/ghasedakapi/Ghasedak-Laravel-Notification/graphs/contributors"><img src="https://img.shields.io/github/contributors/ghasedakapi/laravel.svg?style=flat-square" alt="contributors"></a>  
   <a href="https://github.com/ghasedakapi/Ghasedak-Laravel-Notification/network/members"><img src="https://img.shields.io/github/forks/ghasedakapi/laravel.svg?style=flat-square" alt="forks"></a>  
   <a href="https://github.com/ghasedakapi/Ghasedak-Laravel-Notification/stargazers"><img src="https://img.shields.io/github/stars/ghasedakapi/laravel.svg?style=flat-square" alt="stars"></a>  
   <a href="https://github.com/ghasedakapi/Ghasedak-Laravel-Notification/issues"><img src="https://img.shields.io/github/issues/ghasedakapi/laravel.svg?style=flat-square" alt="issues"></a>  
   <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-green.svg?style=flat-square" alt="license"></a>  
</p>  
    
<!-- TABLE OF CONTENTS -->    
## Table of Contents    
 * [Install](#install)  
   * [Setting up the Ghasedak service](#setting-up-the-ghasedak-service)
   * [Add environmental variables to .env file](#add-environmental-variables-to-env-file)
* [Usage](#usage)    
  * [Parameters of GhasedakSimpleSms() method](#parameters-of-ghasedaksimplesms-method)
  * [Sending Notifications](#sending-notifications)    
  * [Example](#example)    
* [One-Time Passwords (OTP)](#one-time-passwords-otp)
  * [Parameters](#parameters-1)
  * [Example](#example-1)    
* [Licence](#license)
    
## Install    
 The easiest way to install is by using Composer:
  
```php
composer require ghasedak/laravel-notification
```    
Composer is a dependency manager for PHP which allows you to declare the libraries your project depends on, and it will manage (install/update) them for you.  If you are not familiar with Composer, you can read its documentations and download it via [getcomposer.org](https://getcomposer.org/).
### Setting up the Ghasedak service
To setup Ghasedak service properly you need an API key. To get that you should have a [Ghasedak](https://ghasedak.io) account. Register and get your API key.
<br>
Then you need to set simple configuration by adding following code to your `services.php` file.
```php
// config/services.php

'ghasedak' => [
    'api_key' => env("GHASEDAK_API_KEY"),
    'linenumber' => env('LINE_NUMBER', null),
]
```
### Add environmental variables to .env file
As final step of installing the package, you must add previousley defined variables to `.env` file.
```php
GHASEDAK_API_KEY=your_api_key
LINE_NUMBER=your_line_number
```
Don't forget to replace `your_api_key` and `your_line_number` with actual information. 
 ## Usage    
 To use notifications in Laravel you should first create one with simple Artisan command:
 ```shell script
php artisan make:notification SendSimpleNotification
```
Then you can use the channel in your `via()` method inside the notification you just created:
```php
namespace App\Http\Notifications;

use Ghasedak\LaravelNotification\GhasedakChannel;
use Ghasedak\LaravelNotification\GhasedakSimpleSms;
use Illuminate\Notifications\Notification;


class SendSms extends Notification
{
    public function via($notifiable)
    {
        return [GhasedakChannel::class];
    }

    public function toSms($notifiable)
    {
        // send simple message
        return (new GhasedakSimpleSms)->message('Hello, World!')->linenumber('300xxxxx');
    }
}
```
As default `phone` field is set for receptor, but you can add `routeNotificationForSms` method to your Notifiable model to customize phone number:
```php
public function routeNotificationForSms()
{
    return $this->phone;
}
```


 ## Parameters of `GhasedakSimpleSms()` method 
 | Parameter | Required | Description | Type | Example |
 | --- | --- | --- | --- | --- |
 | message | Yes | Text to be sent | string | Hello, World! |
 | receptor |  Yes | The number of the recipient(s) of the message (seperated by comma `,`). | string | 09111111111 |
 | linenumber | No | The number of the sender of the message, which, if not specified, will be selected from your dedicated lines with a higher priority.**```(If you do not have a dedicated line, you must specify the linenumber)```** | string | 5000222 |
 | senddate | No | The exact date and time of sending the message based on Unix time, if not specified, the message will be sent instantly. | string | 1508144471 | | checkid | No | It is used to set a unique number for each SMS, and after sending the SMS, all the information of the sent message can be received with the `status` method. | string | 2071 |
 
## Sending Notifications
Notifications may be sent using the `notify` method of the Notifiable trait:
```php
use Ghasedak\LaravelNotification\GhasedakSimpleSms;

$user->notify(new GhasedakSimpleSms());
```
     
 ## Example
 Here is a sample code for `SendSimple` Notification **with support for custom parameters** instead of using a fixed template:    
```php
// App\Http\Notifications\SendSimpleNotification.php

namespace App\Http\Notifications;

use Ghasedak\LaravelNotification\GhasedakChannel;
use Ghasedak\LaravelNotification\GhasedakSimpleSms;
use Illuminate\Notifications\Notification;

class SendSimpleNotification extends Notification
{
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function via($notifiable)
    {
        return [GhasedakChannel::class];
    }

    public function toSms($notifiable)
    {
        return (new GhasedakSimpleSms)
            ->message($this->params['message'])
            ->linenumber($this->params['linenumber'])
            ->senddate($this->params['senddate'] ?? null)
            ->checkid($this->params['checkid'] ?? null);
    }
}
```
Send notification using `notify` method:
```php
$arr = array(
            'message' => 'Hello, World!', // message 
            'linenumber' => '3000xxxxx', // choose a line number from your account
        );
$user->notify(new GhasedakSimpleSms($arr));
```

 ## One-Time Passwords (OTP) 
 
The One-Time-Password (OTP) Interface is used to perform a mobile authentication or to implement Two-Factor-Authentication (2FA).    

```php
$params = ['1', '2'];
$arr = array(
    'type' => 1,
    'template' => 'template',
    'params' => $params
);
$user->notify(new SendOTPNotification($arr));
 ``` 
## Parameters
| Parameter | Required | Description | Type | Example |
| --- | --- | --- | --- | --- |
| receptor |  Yes | The number of the recipient of the message. | string | 09111111111 |
| type | Yes | Set `1` to send text message and `2` to send voice message. | int | Hello, World! |
| template | Yes | The title of the template you created in your panel. | string | my-template |
| checkid | No | It is used to set a unique number for each SMS, and after sending the SMS, all the information of the sent message can be received with the `status` method. | string | 2071 |
| params | Yes | Array of parameters (You must enter at least one parameter). | array of strings | abcdef |  
    
 ## Example
 The following is a sample code for `SendOTP` Notification **with support for custom parameters** instead of using a fixed template:    
```php
// App\Http\Notifications\SendOTPNotification.php

namespace App\Http\Notifications;

use Ghasedak\LaravelNotification\GhasedakChannel;
use Ghasedak\LaravelNotification\GhasedakOTPSms;
use Illuminate\Notifications\Notification;

class SendOTPNotification extends Notification
{
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function via($notifiable)
    {
        return [GhasedakChannel::class];
    }

    public function toSms($notifiable)
    {
        return (new GhasedakOTPSms)
            ->type($this->params['type'])
            ->template($this->params['template'])
            ->params($this->params['params']);
    }

}
```
Send notification using `notify` method:
```php
$params = ['param1', 'param2', 'param3'];   
$arr = array(
    'type' => 1,      // 1 for text message and 2 for voice message
    'template' => 'my-template', // name of the template which you've created in you account
    'params' => $params, // parameters (supporting up to 10 parameters) 
);
$user->notify(new SendSimpleNotification($arr));
```
 :)    
    
## License
Freely distributable under the terms of the [MIT](https://opensource.org/licenses/MIT) license.    
