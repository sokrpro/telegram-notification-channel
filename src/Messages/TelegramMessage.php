<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages;

use Closure;

class TelegramMessage
{
    public bool $disableNotification;

    public int $replyToMessageId;

    public string $text;

    public bool $disableWebPagePreview;

    public string $parseMode;

    public array $replyMarkup;

    public function silently(): self
    {
        $this->disableNotification = true;

        return $this;
    }

    public function reply(int $messageId): self
    {
        $this->replyToMessageId = $messageId;

        return $this;
    }

    /**
     * @param  string  $text
     * @param  bool    $disableLinkPreviews
     * @param  string  $mode
     *
     * @return $this
     */
    public function text(string $text, bool $disableLinkPreviews = false, string $mode = 'Markdown'): self
    {
        $this->text = $text;
        $this->disableWebPagePreview = $disableLinkPreviews;
        $this->parseMode = $mode;

        return $this;
    }

    /**
     * @param  Closure  $callback
     *
     * @return $this
     */
    public function button(Closure $callback): self
    {
        $this->replyMarkup['inline_keyboard'] = $button = new TelegramButton;

        $callback($button);

        return $this;
    }
}
