<?php

namespace Jiannei\LayAdmin\Contracts;

interface Config
{
    public function parse(): array;

    public function valid(): array;
}