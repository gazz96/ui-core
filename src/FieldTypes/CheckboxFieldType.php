<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder\FieldTypes;

use BagasTopati\FormBuilder\Contracts\FieldType;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class CheckboxFieldType implements FieldType
{
    public function getName(): string
    {
        return 'checkbox';
    }

    public function render(array $config): string
    {
        $fw = UI::framework();
        $name = $config['name'] ?? '';
        $id = $config['id'] ?? $name;
        $checked = ($config['checked'] ?? false) ? ' checked' : '';
        $cbLabel = $config['checkbox_label'] ?? '';
        $attrs = $config['attributes'] ?? [];
        $wrapperClasses = $fw->formCheckbox();

        $attrStr = Renderer::buildAttributes($attrs);
        $html = "<div" . Renderer::classes($wrapperClasses) . ">";
        $html .= "<label>";
        $html .= "<input type='checkbox' name='{$name}' id='{$id}'{$checked}{$attrStr}> {$cbLabel}";
        $html .= "</label>";
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
