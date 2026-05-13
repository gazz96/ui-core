<?php

namespace BagasTopati\UiCore\Rendering;

class Renderer
{
    public static function attrs(array $attrs = []): string
    {
        $html = '';

        foreach ($attrs as $key => $value) {
            if ($value === false || $value === null) {
                continue;
            }

            if ($value === true) {
                $html .= ' ' . $key;
                continue;
            }

            if (is_array($value)) {
                continue;
            }

            $html .= ' ' . $key . '="' . htmlspecialchars((string)$value, ENT_COMPAT, 'UTF-8') . '"';
        }

        return $html;
    }

    public static function classes(array $classes): string
    {
        $classes = array_filter(self::flatten($classes));

        if (empty($classes)) {
            return '';
        }

        return ' class="' . htmlspecialchars(implode(' ', $classes), ENT_QUOTES, 'UTF-8') . '"';
    }

    public static function buildAttributes(array $attributes = [], array $classes = []): string
    {
        $html = '';

        if (!empty($classes)) {
            $html .= self::classes($classes);
        }

        $html .= self::attrs($attributes);

        return $html;
    }

    public static function tag(string $tag, ?string $content = null, array $attributes = [], array $classes = []): string
    {
        $voidTags = ['img', 'br', 'hr', 'input', 'meta', 'link', 'area', 'base', 'col', 'embed', 'source', 'track', 'wbr'];

        $attr = self::buildAttributes($attributes, $classes);

        if (in_array($tag, $voidTags)) {
            return "<{$tag}{$attr}>";
        }

        return "<{$tag}{$attr}>{$content}</{$tag}>";
    }

    public static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    protected static function flatten(array $array): array
    {
        $result = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::flatten($value));
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }
}
