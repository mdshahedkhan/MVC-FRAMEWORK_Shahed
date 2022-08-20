<?php

namespace App\Config;

class Blueprint
{
    protected string $string = '';
    protected string $id     = "";
    protected string $unique = '';

    public function string(string $column, $length = 255): static
    {
        $this->string = "$column VARCHAR($length)";
        return new static();
    }

    /**
     * @return $this
     */
    public function unique(): static
    {
        $this->unique = "UNIQUE";
        return new static();
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id = 'id int NOT NULL AUTO_INCREMENT';
    }
}