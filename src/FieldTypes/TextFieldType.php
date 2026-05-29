<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\FieldTypes;

use BagasTopati\FormBuilder\Contracts\FieldType;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class TextFieldType implements FieldType
{
    public function getName(): string
    {
        return 'text';
    }

    public function render(array $config): string
    {
        $fw = UI::framework();
        $name = $config['name'] ?? '';
        $id = $config['id'] ?? $name;
        $value = $config['value'] ?? null;
        $placeholder = $config['placeholder'] ?? null;
        $attrs = $config['attributes'] ?? [];
        $extraClasses = $config['classes'] ?? [];

        $inputClasses = array_merge($fw->formInput(), $extraClasses);
        $inputAttrs = array_filter(['placeholder' => $placeholder, 'value' => $value] + $attrs);
        $attrStr = Renderer::buildAttributes($inputAttrs, $inputClasses);

        return "<input type='text' name='{$name}' id='{$id}'{$attrStr}>";
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
