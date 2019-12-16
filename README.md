# Ghasedak notification channel for Laravel
This package makes it easy to send notifications using [Ghasedak](https://ghasedak.io/) with Laravel 5.5+ & 6.x.

## Contents
- [Installation](#installation)
    - [Setting up the Ghasedak service](#setting-up-the-Ghasedak-service)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [Security](#security)

## Installation

You can install the package via composer:

```bash
composer require ghasedak/laravel-notification
```

You must install the service provider:
```php
// config/app.php
...
'providers' => [
    ...
Ghasedak\LaravelNotification\GhasedakNotificationServiceProvider::class,
],
...
```
### Setting up the Ghasedak service

You must add the ghasedak config to services.php file , Set your api_key and linenumber by  Log in to your [Ghasedak dashboard](https://developers.ghasedak.io/panel/home) .
```php
// config/services.php
...
'ghasedak' => [
    'api_key' => env("GHASEDAK_API_KEY"),
    'linenumber' => env('LINE_NUMBER', null),
]
```
## Usage

You can use the channel in your `via()` method inside the notification:

```php
namespace App\Notifications;

use Ghasedak\LaravelNotification\GhasedakChannel;
use Ghasedak\LaravelNotification\GhasedakOTPSms;
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
        return (new GhasedakOTPSms)->type(1)->template('yourTemplate')->param1('parame1'); // create otp message
}
```
As default, field `phone` is select for receptor, you can  add a `routeNotificationForSms` method to your Notifiable model to customize the phone number:
```php
public function routeNotificationForSms()
{
    return $this->phone;
}
```
### Available Message methods

#### GhasedakOTPSms
- `type(int $type)` *
- `template(string $template)` *
- `param1(string $param1)` *
- `checkid(string $checkid)`  
- `param2(string $param2)` 
.
.
.
- `param10(string $param10)` 

#### GhasedakSimpleSms
- `message(int $message)` *
- `linenumber(string $linenumber)` *
- `senddate(string $senddate)`  
- `checkid(string $checkid)`  

## Security

If you discover any security related issues, please email salimielham65@gmail.com instead of using the issue tracker.

