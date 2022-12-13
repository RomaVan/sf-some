<?php

namespace App\Command;

class CreateTopicCommand
{
    public function __construct(
        private string $name,
        private array $data
    ) {

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): array
    {
        return $this->data;
    }
}