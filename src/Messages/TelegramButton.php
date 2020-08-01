<?php


namespace Sokrpro\Notifications\Messages;


class TelegramButton
{
    public string $text;

    public ?string $callbackData;

    public ?string $url;

    public function label(string $text, ?string $data, ?string $url): self
    {
        $this->text = $text;
        if (isset($data)) {
            $this->callbackData = $data;
        }

        if (isset($url)) {
            $this->url = $url;
        }

        return $this;
    }
}
