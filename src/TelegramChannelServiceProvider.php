<?php

declare(strict_types=1);

namespace Sokrpro\Notifications;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class TelegramChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('telegram', function ($app) {
                return new Channels\TelegramWebhookChannel($app->make(HttpClient::class));
            });
        });
    }
}
