<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\FieldTypes;

use BagasTopati\FormBuilder\Contracts\FieldType;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class SelectFieldType implements FieldType
{
    public function getName(): string
    {
        return 'select';
    }

    public function render(array $config): string
    {
        $fw = UI::framework();
        $name = $config['name'] ?? '';
        $id = $config['id'] ?? $name;
        $options = $config['options'] ?? [];
        $selected = $config['selected'] ?? null;
        $attrs = $config['attributes'] ?? [];
        $extraClasses = $config['classes'] ?? [];
        $multiple = ($config['multiple'] ?? false) ? ' multiple' : '';

        $inputClasses = array_merge($fw->formSelect(), $extraClasses);
        $attrStr = Renderer::buildAttributes($attrs, $inputClasses);

        $html = "<select name='{$name}' id='{$id}'{$attrStr}{$multiple}>";

        if ($config['placeholder'] ?? null) {
            $html .= "<option value='' disabled selected>{$config['placeholder']}</option>";
        }

        foreach ($options as $key => $label) {
            if (is_array($label)) {
                $html .= "<optgroup label='{$key}'>";
                foreach ($label as $optVal => $optLabel) {
                    $isSelected = $selected == $optVal ? ' selected' : '';
                    $html .= "<option value='{$optVal}'{$isSelected}>{$optLabel}</option>";
                }
                $html .= "</optgroup>";
            } else {
                $isSelected = $selected == $key ? ' selected' : '';
                $html .= "<option value='{$key}'{$isSelected}>{$label}</option>";
            }
        }

        $html .= "</select>";
        return $html;
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
