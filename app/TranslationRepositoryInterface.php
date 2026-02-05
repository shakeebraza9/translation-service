<?php

namespace App;

interface TranslationRepositoryInterface
{
    public function search(array $filters);
    public function export(string $locale, array $tags): array;
}
