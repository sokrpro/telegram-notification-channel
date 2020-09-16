<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Sokrpro\Notifications\Messages\Traits\Message;
use Sokrpro\Notifications\Messages\Traits\Text;
use Sokrpro\Notifications\Messages\Traits\To;
use Sokrpro\Notifications\Messages\Traits\WebPagePreview;

abstract class AbstractUpdateMessage
{
    use To;
    use Text;
    use Message;
    use WebPagePreview;

    public const MARKDOWN_PARSE_MODE = 'markdown';
    public const HTML_PARSE_MODE = 'HTML';

    public string $urlPath = '/editMessageText';

    public function toArray(): array
    {
        $message = [
            'chat_id' => $this->chatId,
            'text' => $this->text,
        ];
        if (isset($this->messageId)) $message['message_id'] = $this->messageId;
        if (isset($this->parseMode)) $message['parse_mode'] = $this->parseMode;
        if (isset($this->disableWebPagePreview)) $message['disable_web_page_preview'] = $this->disableWebPagePreview;

        return $message;
    }
}
