<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Sokrpro\Notifications\Messages\Traits\Notification;
use Sokrpro\Notifications\Messages\Traits\Text;
use Sokrpro\Notifications\Messages\Traits\Reply;
use Sokrpro\Notifications\Messages\Traits\To;
use Sokrpro\Notifications\Messages\Traits\WebPagePreview;

abstract class AbstractSendMessage
{
    use To;
    use Text;
    use Notification;
    use WebPagePreview;
    use Reply;

    public const MARKDOWN_PARSE_MODE = 'markdown';
    public const HTML_PARSE_MODE = 'HTML';

    public string $urlPath = '/sendMessage';

    public function toArray(): array
    {
        $message = [
            'chat_id' => $this->chatId,
            'text' => $this->text,
        ];
        if (isset($this->parseMode)) $message['parse_mode'] = $this->parseMode;
        if (isset($this->disableWebPagePreview)) $message['disable_web_page_preview'] = $this->disableWebPagePreview;
        if (isset($this->disableNotification)) $message['disable_notification'] = $this->disableNotification;
        if (isset($this->replyToMessageId)) $message['reply_to_message_id'] = $this->replyToMessageId;

        return $message;
    }
}
