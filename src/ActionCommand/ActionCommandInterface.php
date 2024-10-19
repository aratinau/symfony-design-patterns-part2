<?php

namespace App\ActionCommand;

interface ActionCommandInterface
{
    public function execute(): void;
    public function undo(): void;
}
