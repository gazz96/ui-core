<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\Contracts;

interface FieldType
{
    public function getName(): string;

    public function render(array $config): string;

    public function getValidationRules(array $config): array;
}
