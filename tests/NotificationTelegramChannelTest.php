<?php

declare(strict_types=1);

use Sokrpro\Notifications\Messages\Buttons\TelegramInlineKeyboardButton;
use Sokrpro\Notifications\Channels\TelegramWebhookChannel;
use Sokrpro\Notifications\Messages\TelegramSendInlineKeyboardMarkupMessage;
use Sokrpro\Notifications\Messages\TelegramDeleteMessage;
use Sokrpro\Notifications\Messages\TelegramSendMessage;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class NotificationTelegramChannelTest extends TestCase
{
    private TelegramWebhookChannel $telegramChannel;

    /**
     * @var \Mockery\MockInterface|\GuzzleHttp\Client
     */
    private $guzzleHttp;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guzzleHttp = m::mock(Client::class);

        $this->telegramChannel = new TelegramWebhookChannel($this->guzzleHttp);
    }

    protected function tearDown(): void
    {
        m::close();
    }

    /**
     * @dataProvider payloadDataProvider
     */
    public function testCorrectPayloadIsSentToTelegram(Notification $notification, array $payload, string $urlPath)
    {
        $this->guzzleHttp->shouldReceive('post')
            ->andReturnUsing(
                function ($argUrl, $argPayload) use ($payload, $urlPath) {
                    $this->assertEquals($argUrl, sprintf('%s%s', 'url', $urlPath));
                    $this->assertEquals($argPayload, $payload);

                    return new Response();
                }
            );

        $this->telegramChannel->send(new NotificationTelegramChannelTestNotifiable, $notification);
    }

    public function payloadDataProvider()
    {
        return [
            'sendMessage' => $this->getSendMessage(),
            'sendInlineKeyboardMarkupMessage' => $this->getSendInlineKeyboardMarkupMessage(),
            'deleteMessage' => $this->getDeleteMessage(),
        ];
    }

    public function getSendMessage()
    {
        return [
            new NotificationTelegramChannelSendMessageTestNotification,
            [
                'json' => [
                    'chat_id' => 123,
                    'reply_to_message_id' => 321,
                    'text' => 'Message',
                    'parse_mode' => 'markdown',
                    'disable_notification' => true,
                    'disable_web_page_preview' => true,
                ],
            ],
            '/sendMessage',
        ];
    }

    public function getDeleteMessage()
    {
        return [
            new NotificationTelegramChannelDeleteMessageTestNotification,
            [
                'json' => [
                    'chat_id' => 123,
                    'message_id' => 333,
                ]
            ],
            '/deleteMessage',
        ];
    }

    public function getSendInlineKeyboardMarkupMessage()
    {
        return [
            new NotificationTelegramChannelSendInlineKeyboardMarkupMessageTestNotification,
            [
                'json' => [
                    'chat_id' => 123,
                    'reply_to_message_id' => 321,
                    'text' => 'Message',
                    'parse_mode' => 'markdown',
                    'disable_notification' => true,
                    'disable_web_page_preview' => true,
                    'reply_markup' => [
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => 'First Button',
                                    'callback_data' => 'some_data',
                                ],
                            ], [
                                [
                                    'text' => 'Url Button',
                                    'url' => 'some_url',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            '/sendMessage',
        ];
    }
}

class NotificationTelegramChannelTestNotifiable
{
    use Notifiable;

    public function routeNotificationForTelegram()
    {
        return 'url';
    }
}

class NotificationTelegramChannelSendMessageTestNotification extends Notification
{
    public function toTelegram($notifiable)
    {
        return (new TelegramSendMessage)
            ->to(123)
            ->reply(321)
            ->text('Message', TelegramSendMessage::MARKDOWN_PARSE_MODE)
            ->disableNotification()
            ->disableWebPagePreview();
    }
}

class NotificationTelegramChannelSendInlineKeyboardMarkupMessageTestNotification extends Notification
{
    public function toTelegram($notifiable)
    {
        return (new TelegramSendInlineKeyboardMarkupMessage)
            ->to(123)
            ->reply(321)
            ->text('Message', TelegramSendMessage::MARKDOWN_PARSE_MODE)
            ->disableNotification()
            ->disableWebPagePreview()
            ->button(function (TelegramInlineKeyboardButton $button) {
                $button
                    ->text('First Button')
                    ->callbackData('some_data');
            })
            ->button(function (TelegramInlineKeyboardButton $button) {
                $button
                    ->text('Url Button')
                    ->url('some_url');
            }, 1);
    }
}

class NotificationTelegramChannelDeleteMessageTestNotification extends Notification
{
    public function toTelegram($notifiable)
    {
        return (new TelegramDeleteMessage)
            ->to(123)
            ->message(333);
    }
}
