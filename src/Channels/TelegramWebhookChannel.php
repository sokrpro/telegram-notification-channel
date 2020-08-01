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
     * @var HttpClient
     */
    protected HttpClient $http;

    /**
     * Create a new Slack channel instance.
     *
     * @param  HttpClient  $http
     * @return void
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function send($notifiable, Notification $notification)
    {
        if (! $url = $notifiable->routeNotificationFor('slack', $notification)) {
            return;
        }
    }
}
