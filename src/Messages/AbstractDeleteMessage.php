<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Sokrpro\Notifications\Messages\Traits\Message;
use Sokrpro\Notifications\Messages\Traits\To;

abstract class AbstractDeleteMessage
{
    use To;
    use Message;

    public string $urlPath = '/deleteMessage';

    public function toArray()
    {
        return [
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
        ];
    }
}
