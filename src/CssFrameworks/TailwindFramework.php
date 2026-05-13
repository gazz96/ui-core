<?php

namespace BagasTopati\UiCore\CssFrameworks;

use BagasTopati\UiCore\Contracts\CssFramework;

class TailwindFramework implements CssFramework
{
    public function name(): string
    {
        return 'tailwind';
    }

    public function grid(int $columns, string $gap): array
    {
        $gapClass = $this->gapClass($gap);
        return ['grid', "grid-cols-{$columns}", $gapClass];
    }

    public function flexRow(string $gap): array
    {
        return ['flex', 'flex-row', $this->gapClass($gap)];
    }

    public function flexCol(string $gap): array
    {
        return ['flex', 'flex-col', $this->gapClass($gap)];
    }

    public function flexCenter(): array
    {
        return ['flex', 'items-center', 'justify-center'];
    }

    public function flexBetween(): array
    {
        return ['flex', 'items-center', 'justify-between'];
    }

    public function flexWrap(): array
    {
        return ['flex-wrap'];
    }

    public function container(bool $fluid, ?string $maxWidth): array
    {
        return $fluid ? ['w-full'] : ['container', 'mx-auto', 'px-6'];
    }

    public function card(?string $variant): array
    {
        $base = ['bg-white', 'border', 'border-gray-200', 'rounded-lg', 'overflow-hidden', 'shadow-sm'];
        return match ($variant) {
            'primary' => array_merge($base, ['border-l-4', 'border-l-blue-500', 'bg-blue-50']),
            'success' => array_merge($base, ['border-l-4', 'border-l-green-500', 'bg-green-50']),
            'warning' => array_merge($base, ['border-l-4', 'border-l-amber-500', 'bg-amber-50']),
            'danger' => array_merge($base, ['border-l-4', 'border-l-red-500', 'bg-red-50']),
            'info' => array_merge($base, ['border-l-4', 'border-l-cyan-500', 'bg-cyan-50']),
            default => $base,
        };
    }

    public function cardHeader(): array
    {
        return ['p-4', 'border-b', 'border-gray-200'];
    }

    public function cardBody(): array
    {
        return ['p-4'];
    }

    public function cardFooter(): array
    {
        return ['px-4', 'py-3', 'border-t', 'border-gray-200', 'bg-gray-50', 'text-sm', 'text-gray-500'];
    }

    public function cardImage(): array
    {
        return ['w-full', 'block'];
    }

    public function alert(string $variant): array
    {
        return match ($variant) {
            'success' => ['p-4', 'rounded-lg', 'border-l-4', 'border-l-green-500', 'bg-green-50', 'text-green-800', 'mb-2', 'flex', 'items-start', 'gap-2'],
            'warning' => ['p-4', 'rounded-lg', 'border-l-4', 'border-l-amber-500', 'bg-amber-50', 'text-amber-800', 'mb-2', 'flex', 'items-start', 'gap-2'],
            'danger' => ['p-4', 'rounded-lg', 'border-l-4', 'border-l-red-500', 'bg-red-50', 'text-red-800', 'mb-2', 'flex', 'items-start', 'gap-2'],
            default => ['p-4', 'rounded-lg', 'border-l-4', 'border-l-blue-500', 'bg-blue-50', 'text-blue-800', 'mb-2', 'flex', 'items-start', 'gap-2'],
        };
    }

    public function alertTitle(): array
    {
        return ['block', 'mb-1', 'font-semibold'];
    }

    public function alertBody(): array
    {
        return ['flex-1'];
    }

    public function alertDismiss(): array
    {
        return ['bg-transparent', 'border-none', 'text-xl', 'cursor-pointer', 'p-0', 'leading-none'];
    }

    public function table(): array
    {
        return ['min-w-full', 'border-collapse'];
    }

    public function tableStriped(): array
    {
        return ['[&_tr:nth-child(even)_td]:bg-gray-50'];
    }

    public function tableBordered(): array
    {
        return ['border', 'border-gray-300'];
    }

    public function tableHoverable(): array
    {
        return ['[&_tr:hover_td]:bg-blue-50'];
    }

    public function tableCompact(): array
    {
        return [];
    }

    public function tableResponsive(): array
    {
        return ['overflow-x-auto'];
    }

    public function tableHeader(): array
    {
        return [];
    }

    public function tableHeaderCell(): array
    {
        return ['px-4', 'py-3', 'text-left', 'bg-gray-100', 'border-b-2', 'border-gray-300', 'font-semibold'];
    }

    public function tableBody(): array
    {
        return [];
    }

    public function tableRow(int $rowIndex, bool $striped): array
    {
        return [];
    }

    public function tableCell(): array
    {
        return ['px-4', 'py-3', 'border-b', 'border-gray-200'];
    }

    public function tableCaption(): array
    {
        return ['text-left', 'px-2', 'py-2', 'font-semibold'];
    }

    public function formGroup(): array
    {
        return ['mb-4'];
    }

    public function formLabel(): array
    {
        return ['block', 'mb-1', 'font-medium', 'text-sm'];
    }

    public function formInput(): array
    {
        return ['block', 'w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'text-base', 'focus:outline-none', 'focus:border-blue-500', 'focus:ring-2', 'focus:ring-blue-200'];
    }

    public function formSelect(): array
    {
        return ['block', 'w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'text-base', 'bg-white', 'focus:outline-none', 'focus:border-blue-500', 'focus:ring-2', 'focus:ring-blue-200'];
    }

    public function formTextarea(): array
    {
        return ['block', 'w-full', 'px-3', 'py-2', 'border', 'border-gray-300', 'rounded-md', 'text-base', 'focus:outline-none', 'focus:border-blue-500', 'focus:ring-2', 'focus:ring-blue-200'];
    }

    public function formCheckbox(): array
    {
        return ['inline-flex', 'items-center', 'gap-1'];
    }

    public function formRadio(): array
    {
        return ['inline-flex', 'items-center', 'gap-1'];
    }

    public function formRow(): array
    {
        return ['flex', 'gap-3'];
    }

    public function formRowItem(): array
    {
        return ['flex-1'];
    }

    public function buttonPrimary(): array
    {
        return ['px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'border', 'border-transparent', 'text-base', 'cursor-pointer', 'hover:bg-blue-600'];
    }

    public function buttonSecondary(): array
    {
        return ['px-4', 'py-2', 'bg-gray-200', 'text-gray-700', 'rounded-md', 'border', 'border-transparent', 'text-base', 'cursor-pointer'];
    }

    public function button(?string $variant): array
    {
        return match ($variant) {
            'primary' => $this->buttonPrimary(),
            'secondary' => $this->buttonSecondary(),
            'success' => ['px-4', 'py-2', 'bg-green-500', 'text-white', 'rounded-md', 'border', 'border-transparent', 'text-base', 'cursor-pointer', 'hover:bg-green-600'],
            'danger' => ['px-4', 'py-2', 'bg-red-500', 'text-white', 'rounded-md', 'border', 'border-transparent', 'text-base', 'cursor-pointer', 'hover:bg-red-600'],
            'warning' => ['px-4', 'py-2', 'bg-amber-500', 'text-white', 'rounded-md', 'border', 'border-transparent', 'text-base', 'cursor-pointer', 'hover:bg-amber-600'],
            default => ['px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded-md', 'border', 'border-transparent', 'text-base', 'cursor-pointer'],
        };
    }

    public function navbar(?string $variant): array
    {
        $base = ['flex', 'items-center', 'justify-between', 'px-6', 'py-3', 'shadow-sm', 'sticky', 'top-0', 'z-50'];
        return match ($variant) {
            'dark' => array_merge($base, ['bg-gray-800', 'text-white']),
            'primary' => array_merge($base, ['bg-blue-500', 'text-white']),
            default => array_merge($base, ['bg-white', 'text-gray-700']),
        };
    }

    public function navbarBrand(): array
    {
        return ['font-bold', 'text-lg', 'no-underline', 'text-inherit'];
    }

    public function navbarLinks(): array
    {
        return ['flex', 'items-center', 'gap-6'];
    }

    public function navbarLink(bool $active): array
    {
        $classes = ['no-underline', 'text-inherit', 'px-3', 'py-1.5', 'rounded'];
        if ($active) {
            $classes[] = 'bg-white/15';
        }
        return $classes;
    }

    public function sidebar(?string $variant): array
    {
        $base = ['w-64', 'min-h-screen', 'py-4', 'flex-shrink-0'];
        return match ($variant) {
            'dark' => array_merge($base, ['bg-gray-800', 'text-gray-300', 'border-r', 'border-gray-700']),
            default => array_merge($base, ['bg-gray-50', 'text-gray-700', 'border-r', 'border-gray-200']),
        };
    }

    public function sidebarHeader(): array
    {
        return ['px-5', 'pb-4', 'font-bold', 'text-lg', 'border-b', 'border-gray-200', 'mb-2'];
    }

    public function sidebarItem(bool $active): array
    {
        $classes = ['block', 'px-5', 'py-2', 'no-underline'];
        if ($active) {
            $classes = array_merge($classes, ['bg-blue-50', 'text-blue-600', 'font-semibold']);
        } else {
            $classes[] = 'text-inherit';
        }
        return $classes;
    }

    public function sidebarDivider(): array
    {
        return ['border-t', 'border-gray-200', 'my-2'];
    }

    public function sidebarHeading(): array
    {
        return ['px-5', 'pt-3', 'pb-1', 'text-xs', 'uppercase', 'tracking-wider', 'text-gray-400'];
    }

    public function modalOverlay(): array
    {
        return ['hidden', 'fixed', 'inset-0', 'bg-black/50', 'z-50', 'flex', 'items-center', 'justify-center'];
    }

    public function modalDialog(string $size, bool $centered): array
    {
        $base = ['bg-white', 'rounded-xl', 'shadow-2xl', 'max-h-[90vh]', 'overflow-auto'];
        $sizeClasses = match ($size) {
            'small' => ['max-w-md', 'w-full'],
            'large' => ['max-w-3xl', 'w-full'],
            'fullscreen' => ['max-w-[95vw]', 'w-full'],
            default => ['max-w-xl', 'w-full'],
        };
        return array_merge($base, $sizeClasses);
    }

    public function modalHeader(): array
    {
        return ['flex', 'justify-between', 'items-center', 'px-5', 'py-4', 'border-b', 'border-gray-200'];
    }

    public function modalBody(): array
    {
        return ['p-5'];
    }

    public function modalFooter(): array
    {
        return ['flex', 'justify-end', 'gap-2', 'px-5', 'py-3', 'border-t', 'border-gray-200', 'bg-gray-50', 'rounded-b-xl'];
    }

    public function modalClose(): array
    {
        return ['bg-transparent', 'border-none', 'text-2xl', 'cursor-pointer', 'text-gray-400', 'p-0', 'leading-none'];
    }

    public function modalContent(): array
    {
        return ['bg-white', 'rounded-xl', 'shadow-2xl'];
    }

    public function modalShowScript(string $id): string
    {
        return "document.getElementById('{$id}').classList.remove('hidden');document.getElementById('{$id}').classList.add('flex')";
    }

    public function modalHideScript(string $id): string
    {
        return "document.getElementById('{$id}').classList.remove('flex');document.getElementById('{$id}').classList.add('hidden')";
    }

    public function externalJsUrls(): array
    {
        return [];
    }

    public function list(string $type, bool $styled): array
    {
        return $styled ? [] : ['list-none', 'pl-0'];
    }

    public function listItem(): array
    {
        return [];
    }

    public function tabsContainer(): array
    {
        return [];
    }

    public function tabsNav(): array
    {
        return ['flex', 'border-b-2', 'border-gray-200', 'mb-4'];
    }

    public function tabButton(bool $active): array
    {
        $classes = ['px-5', 'py-2.5', 'border-none', 'bg-transparent', 'cursor-pointer', 'text-base'];
        if ($active) {
            $classes = array_merge($classes, ['font-semibold', 'text-blue-500', 'border-b-2', 'border-blue-500', '-mb-0.5']);
        } else {
            $classes = array_merge($classes, ['text-gray-500', 'border-b-2', 'border-transparent', '-mb-0.5']);
        }
        return $classes;
    }

    public function tabContent(): array
    {
        return [];
    }

    public function pageBody(): array
    {
        return ['font-sans', 'leading-normal', 'text-gray-800', 'bg-white'];
    }

    public function pageTitle(): array
    {
        return ['mb-6', 'text-2xl', 'font-bold'];
    }

    public function generateStylesheet(): string
    {
        return '';
    }

    public function requiresExternalCss(): bool
    {
        return true;
    }

    public function externalCssUrls(): array
    {
        return ['https://cdn.tailwindcss.com'];
    }

    protected function gapClass(string $gap): string
    {
        $map = [
            '0px' => 'gap-0', '4px' => 'gap-1', '8px' => 'gap-2', '12px' => 'gap-3',
            '16px' => 'gap-4', '20px' => 'gap-5', '24px' => 'gap-6', '32px' => 'gap-8',
        ];
        return $map[$gap] ?? 'gap-4';
    }

    public function resolveUtility(string $category, array $params): ?string
    {
        return match ($category) {
            'spacing' => $this->resolveTwSpacing(
                $params['property'] ?? 'margin',
                $params['side'] ?? null,
                $params['size'] ?? '0',
                $params['breakpoint'] ?? null
            ),
            'gap' => $this->resolveTwGap($params['size'] ?? '0', $params['breakpoint'] ?? null),
            'display' => $this->resolveTwDisplay($params['value'] ?? 'block', $params['breakpoint'] ?? null),
            'flexDirection' => 'flex-' . $params['value'],
            'flexWrap' => 'flex-' . $params['value'],
            'alignItems' => 'items-' . $params['value'],
            'justifyContent' => 'justify-' . $params['value'],
            'text' => $this->resolveTwText($params['property'] ?? 'align', $params['value'] ?? ''),
            'background' => 'bg-' . $params['value'],
            'bgOpacity' => 'bg-opacity-' . $params['value'],
            'border' => $this->resolveTwBorder($params['value'] ?? '', $params['side'] ?? null),
            'borderRadius' => $this->resolveTwBorderRadius($params['value'] ?? '', $params['side'] ?? null),
            'width' => 'w-' . $params['value'],
            'height' => 'h-' . $params['value'],
            'maxWidth' => 'max-w-' . $params['value'],
            'maxHeight' => 'max-h-' . $params['value'],
            'viewportWidth' => 'w-screen',
            'viewportHeight' => 'h-screen',
            'position' => $params['value'],
            'top' => 'top-' . $params['value'],
            'bottom' => 'bottom-' . $params['value'],
            'start' => 'left-' . $params['value'],
            'end' => 'right-' . $params['value'],
            'overflow' => 'overflow-' . $params['value'],
            'shadow' => $this->resolveTwShadow($params['value'] ?? null),
            'opacity' => 'opacity-' . $params['value'],
            'zIndex' => 'z-' . $params['value'],
            'float' => 'float-' . $params['value'],
            'clear' => 'clear-' . ($params['value'] ?? 'both'),
            'cursor' => 'cursor-' . $params['value'],
            'userSelect' => 'select-' . $params['value'],
            'pointerEvents' => 'pointer-events-' . $params['value'],
            'visibility' => $params['value'],
            'order' => 'order-' . $params['value'],
            'col' => $this->resolveTwCol($params['value'] ?? '', $params['breakpoint'] ?? null),
            'offset' => $this->resolveTwOffset($params['value'] ?? '0', $params['breakpoint'] ?? null),
            default => null,
        };
    }

    protected function resolveTwSpacing(string $property, ?string $side, string $size, ?string $breakpoint): string
    {
        $prefix = $property === 'margin' ? 'm' : 'p';
        $sideMap = [
            'top' => 't', 'bottom' => 'b',
            'start' => 'l', 'end' => 'r',
            'x' => 'x', 'y' => 'y',
        ];
        if ($side && isset($sideMap[$side])) {
            $prefix .= $sideMap[$side];
        }
        if ($breakpoint) {
            return "{$breakpoint}:{$prefix}-{$size}";
        }
        return "{$prefix}-{$size}";
    }

    protected function resolveTwGap(string $size, ?string $breakpoint): string
    {
        if ($breakpoint) {
            return "{$breakpoint}:gap-{$size}";
        }
        return "gap-{$size}";
    }

    protected function resolveTwDisplay(string $value, ?string $breakpoint): string
    {
        $prefix = $breakpoint ? "{$breakpoint}:" : '';
        return "{$prefix}{$value}";
    }

    protected function resolveTwText(string $property, string $value): string
    {
        return match ($property) {
            'align' => "text-{$value}",
            'color' => "text-{$value}",
            'size' => "text-{$value}",
            'weight' => "font-{$value}",
            'transform' => "{$value}",
            'decoration' => "underline",
            'wrap' => "text-{$value}",
            'opacity' => "text-opacity-{$value}",
            default => "text-{$value}",
        };
    }

    protected function resolveTwBorder(string $value, ?string $side): string
    {
        $sideMap = [
            'top' => 't', 'bottom' => 'b',
            'start' => 'l', 'end' => 'r',
        ];
        if ($value === '0') {
            if ($side && isset($sideMap[$side])) {
                return "border-{$sideMap[$side]}-0";
            }
            return 'border-0';
        }
        if ($value && $side && isset($sideMap[$side])) {
            return "border-{$sideMap[$side]} border-{$value}";
        }
        if ($value) {
            return "border-{$value}";
        }
        if ($side && isset($sideMap[$side])) {
            return "border-{$sideMap[$side]}";
        }
        return 'border';
    }

    protected function resolveTwBorderRadius(string $value, ?string $side): string
    {
        $sideMap = [
            'top' => 't', 'bottom' => 'b',
            'start' => 'l', 'end' => 'r',
        ];
        if ($value === 'circle') return 'rounded-full';
        if ($value === 'pill') return 'rounded-full';
        if ($side && isset($sideMap[$side])) {
            return "rounded-{$sideMap[$side]}-{$value ?: 'lg'}";
        }
        return $value ? "rounded-{$value}" : 'rounded';
    }

    protected function resolveTwShadow(?string $value): string
    {
        return match ($value) {
            null, '' => 'shadow',
            'none' => 'shadow-none',
            'sm' => 'shadow-sm',
            'lg' => 'shadow-lg',
            default => 'shadow',
        };
    }

    protected function resolveTwCol(string $value, ?string $breakpoint): string
    {
        $prefix = $breakpoint ? "{$breakpoint}:" : '';
        return $value ? "{$prefix}col-span-{$value}" : "{$prefix}col";
    }

    protected function resolveTwOffset(string $value, ?string $breakpoint): string
    {
        $prefix = $breakpoint ? "{$breakpoint}:" : '';
        return "{$prefix}col-start-{$value}";
    }

    public function accordion(): array
    {
        return ['divide-y', 'divide-gray-200', 'border', 'border-gray-200', 'rounded-lg'];
    }

    public function accordionItem(bool $open): array
    {
        return [];
    }

    public function accordionHeader(): array
    {
        return ['flex', 'items-center', 'justify-between', 'w-full', 'py-4', 'px-5', 'text-left', 'font-medium', 'hover:bg-gray-50', 'cursor-pointer'];
    }

    public function accordionButton(bool $collapsed): array
    {
        return [];
    }

    public function accordionCollapse(): array
    {
        return [];
    }

    public function accordionBody(): array
    {
        return ['px-5', 'py-4', 'text-gray-600'];
    }

    public function breadcrumb(): array
    {
        return ['flex', 'items-center', 'gap-2', 'text-sm', 'text-gray-500'];
    }

    public function breadcrumbItem(bool $active): array
    {
        if ($active) {
            return ['text-gray-800', 'font-medium'];
        }
        return ['hover:text-gray-700'];
    }

    public function badge(?string $variant, bool $pill): array
    {
        $classes = ['inline-flex', 'items-center', 'text-xs', 'font-medium', 'px-2.5', 'py-0.5'];
        if ($pill) {
            $classes[] = 'rounded-full';
        } else {
            $classes[] = 'rounded';
        }
        $variantMap = [
            'primary' => 'bg-blue-100', 'secondary' => 'bg-gray-100',
            'success' => 'bg-green-100', 'danger' => 'bg-red-100',
            'warning' => 'bg-yellow-100', 'info' => 'bg-cyan-100',
        ];
        if ($variant && isset($variantMap[$variant])) {
            $classes[] = $variantMap[$variant];
        }
        return $classes;
    }

    public function buttonGroup(?string $size): array
    {
        return ['inline-flex'];
    }

    public function buttonToolbar(): array
    {
        return ['inline-flex', 'flex-wrap', 'gap-2'];
    }

    public function carousel(): array
    {
        return ['relative', 'overflow-hidden', 'rounded-lg'];
    }

    public function carouselInner(): array
    {
        return ['flex', 'transition-transform', 'duration-500'];
    }

    public function carouselItem(bool $active): array
    {
        $classes = ['w-full', 'flex-shrink-0'];
        return $classes;
    }

    public function carouselIndicator(bool $active): array
    {
        $classes = ['w-3', 'h-3', 'rounded-full'];
        if ($active) {
            $classes[] = 'bg-white';
        } else {
            $classes[] = 'bg-white/50';
        }
        return $classes;
    }

    public function carouselControl(string $direction): array
    {
        return ['absolute', 'top-1/2', '-translate-y-1/2', 'bg-black/30', 'text-white', 'p-2', 'cursor-pointer', 'hover:bg-black/50'];
    }

    public function collapse(): array
    {
        return ['overflow-hidden', 'transition-all', 'duration-300'];
    }

    public function dropdown(): array
    {
        return ['relative', 'inline-block'];
    }

    public function dropdownMenu(): array
    {
        return ['absolute', 'right-0', 'mt-2', 'py-1', 'w-48', 'bg-white', 'rounded-md', 'shadow-lg', 'border', 'z-50'];
    }

    public function dropdownItem(bool $active, bool $disabled): array
    {
        $classes = ['block', 'px-4', 'py-2', 'text-sm', 'hover:bg-gray-100'];
        if ($active) {
            $classes[] = 'bg-gray-50';
        }
        if ($disabled) {
            $classes[] = 'opacity-50', 'pointer-events-none';
        }
        return $classes;
    }

    public function dropdownDivider(): array
    {
        return ['border-t', 'my-1'];
    }

    public function dropdownHeader(): array
    {
        return ['px-4', 'py-2', 'text-xs', 'font-semibold', 'text-gray-500', 'uppercase'];
    }

    public function offcanvas(string $placement): array
    {
        $classes = ['fixed', 'bg-white', 'shadow-xl', 'z-50', 'transition-transform', 'duration-300'];
        $placementMap = [
            'start' => 'top-0 left-0 h-full',
            'end' => 'top-0 right-0 h-full',
            'top' => 'top-0 left-0 w-full',
            'bottom' => 'bottom-0 left-0 w-full',
        ];
        if (isset($placementMap[$placement])) {
            $classes = array_merge($classes, explode(' ', $placementMap[$placement]));
        }
        return $classes;
    }

    public function offcanvasHeader(): array
    {
        return ['flex', 'items-center', 'justify-between', 'p-4', 'border-b'];
    }

    public function offcanvasBody(): array
    {
        return ['p-4'];
    }

    public function offcanvasShowScript(string $id): string
    {
        return "document.getElementById('{$id}').classList.remove('translate-x-full');document.getElementById('{$id}').classList.remove('translate-y-full')";
    }

    public function offcanvasHideScript(string $id): string
    {
        return "document.getElementById('{$id}').classList.add('translate-x-full')";
    }

    public function pagination(): array
    {
        return ['flex', 'items-center', 'gap-1'];
    }

    public function paginationItem(bool $active, bool $disabled): array
    {
        return [];
    }

    public function paginationLink(bool $active, bool $disabled): array
    {
        $classes = ['px-3', 'py-1', 'rounded', 'text-sm'];
        if ($active) {
            $classes = array_merge($classes, ['bg-blue-500', 'text-white']);
        } elseif ($disabled) {
            $classes = array_merge($classes, ['text-gray-400', 'pointer-events-none']);
        } else {
            $classes = array_merge($classes, ['hover:bg-gray-100']);
        }
        return $classes;
    }

    public function placeholder(): array
    {
        return ['animate-pulse', 'bg-gray-200', 'rounded'];
    }

    public function placeholderCol(int $size): array
    {
        return ['animate-pulse', 'bg-gray-200', 'rounded', 'h-5'];
    }

    public function popover(): array
    {
        return ['absolute', 'z-50', 'bg-white', 'rounded-lg', 'shadow-lg', 'border', 'p-3'];
    }

    public function progress(): array
    {
        return ['w-full', 'bg-gray-200', 'rounded-full', 'h-2.5'];
    }

    public function progressBar(?string $variant, bool $striped, bool $animated): array
    {
        $classes = ['h-full', 'rounded-full', 'transition-all'];
        $variantMap = [
            'primary' => 'bg-blue-500', 'success' => 'bg-green-500',
            'danger' => 'bg-red-500', 'warning' => 'bg-yellow-500',
            'info' => 'bg-cyan-500',
        ];
        if ($variant && isset($variantMap[$variant])) {
            $classes[] = $variantMap[$variant];
        }
        return $classes;
    }

    public function spinner(?string $variant, string $type): array
    {
        $classes = $type === 'grow' ? ['animate-pulse'] : ['animate-spin'];
        $classes[] = 'inline-block';
        if ($type !== 'grow') {
            $classes[] = 'border-2';
            $classes[] = 'border-current';
            $classes[] = 'border-r-transparent';
            $classes[] = 'rounded-full';
        }
        return $classes;
    }

    public function toast(): array
    {
        return ['bg-white', 'border', 'rounded-lg', 'shadow-lg', 'p-4', 'max-w-sm'];
    }

    public function toastHeader(): array
    {
        return ['flex', 'items-center', 'justify-between', 'pb-2', 'border-b', 'mb-2'];
    }

    public function toastBody(): array
    {
        return ['text-sm', 'text-gray-600'];
    }

    public function tooltip(): array
    {
        return ['absolute', 'z-50', 'bg-gray-800', 'text-white', 'text-xs', 'rounded', 'py-1', 'px-2'];
    }
}
