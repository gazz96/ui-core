<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\FieldTypes;

use BagasTopati\FormBuilder\Contracts\FieldType;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class RadioFieldType implements FieldType
{
    public function getName(): string
    {
        return 'radio';
    }

    public function render(array $config): string
    {
        $fw = UI::framework();
        $name = $config['name'] ?? '';
        $id = $config['id'] ?? $name;
        $options = $config['options'] ?? [];
        $checked = $config['checked'] ?? null;
        $attrs = $config['attributes'] ?? [];
        $wrapperClasses = $fw->formRadio();

        $html = "<div" . Renderer::classes($wrapperClasses) . ">";

        $idx = 0;
        foreach ($options as $key => $label) {
            $isChecked = $checked == $key ? ' checked' : '';
            $radioId = "{$id}_{$idx}";
            $attrStr = Renderer::buildAttributes($attrs);
            $html .= "<label><input type='radio' name='{$name}' id='{$radioId}' value='{$key}'{$isChecked}{$attrStr}> {$label}</label> ";
            $idx++;
        }

        $html .= "</div>";
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
