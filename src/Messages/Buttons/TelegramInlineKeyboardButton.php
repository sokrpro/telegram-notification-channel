<?php

declare(strict_types=1);

namespace Sokrpro\Notifications\Messages\Buttons;

class TelegramInlineKeyboardButton
{
    public string $text;

    public string $url;

    public string $callbackData;

    public function text(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function callbackData(string $data): self
    {
        $this->callbackData = $data;

        return $this;
    }

    public function toArray()
    {
        $button = [
            'text' => $this->text,
        ];
        if (isset($this->url)) $button['url'] = $this->url;
        if (isset($this->callbackData)) $button['callback_data'] = $this->callbackData;

        return $button;
    }
}
