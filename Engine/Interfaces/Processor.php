<?php

namespace Engine;

interface Processor {
    public static function read(string $filename): array;
    public static function process(array $data): array;
    public static function save(array $data, string $name = null): string;
}