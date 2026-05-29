<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\FieldTypes;

use BagasTopati\FormBuilder\Contracts\FieldType;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class TextareaFieldType implements FieldType
{
    public function getName(): string
    {
        return 'textarea';
    }

    public function render(array $config): string
    {
        $fw = UI::framework();
        $name = $config['name'] ?? '';
        $id = $config['id'] ?? $name;
        $value = $config['value'] ?? null;
        $placeholder = $config['placeholder'] ?? null;
        $rows = $config['rows'] ?? 4;
        $cols = $config['cols'] ?? null;
        $attrs = $config['attributes'] ?? [];
        $extraClasses = $config['classes'] ?? [];

        $content = $value !== null ? Renderer::escape((string)$value) : '';
        $inputClasses = array_merge($fw->formTextarea(), $extraClasses);
        $attrStr = Renderer::buildAttributes(
            array_filter(['rows' => $rows, 'cols' => $cols, 'placeholder' => $placeholder] + $attrs),
            $inputClasses
        );

        return "<textarea name='{$name}' id='{$id}'{$attrStr}>{$content}</textarea>";
    }

    public function getValidationRules(array $config): array
    {
        $rules = [];
        if (!empty($config['validation'])) {
            $rules[$config['name']] = $config['validation'];
        }
        return $rules;
    }
}
