<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Channels;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Notifications\Notification;

class TelegramWebhookChannel
{
    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected HttpClient $http;

    /**
     * Create a new Telegram channel instance.
     *
     * @param  \GuzzleHttp\Client  $http
     * @return void
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \Psr\Http\Message\ResponseInterface|void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $url = $notifiable->routeNotificationFor('telegram', $notification)) {
            return;
        }

        $message = $notification->toTelegram($notifiable);
        $url = \sprintf('%s%s', $url, $message->urlPath);

        return $this->http->post($url, ['json' => $message->toArray()]);
    }
}
