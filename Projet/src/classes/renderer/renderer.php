<?php

namespace iutnc\netVOD\renderer;

interface renderer
{
    const COMPACT = 1;
    const LONG = 2;

    public function render(int $selector): string;
}