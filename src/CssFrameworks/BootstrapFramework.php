<?php

namespace BagasTopati\UiCore\CssFrameworks;

use BagasTopati\UiCore\Contracts\CssFramework;

class BootstrapFramework implements CssFramework
{
    public function name(): string
    {
        return 'bootstrap';
    }

    public function grid(int $columns, string $gap): array
    {
        return ['row', "row-cols-{$columns}", 'g-3'];
    }

    public function flexRow(string $gap): array
    {
        return ['d-flex', 'flex-row', 'gap-3'];
    }

    public function flexCol(string $gap): array
    {
        return ['d-flex', 'flex-column', 'gap-3'];
    }

    public function flexCenter(): array
    {
        return ['d-flex', 'align-items-center', 'justify-content-center'];
    }

    public function flexBetween(): array
    {
        return ['d-flex', 'align-items-center', 'justify-content-between'];
    }

    public function flexWrap(): array
    {
        return ['flex-wrap'];
    }

    public function container(bool $fluid, ?string $maxWidth): array
    {
        return $fluid ? ['container-fluid'] : ['container'];
    }

    public function card(?string $variant): array
    {
        $base = ['card'];
        if ($variant && $variant !== 'default') {
            $base[] = "border-{$this->bsVariant($variant)}";
        }
        return $base;
    }

    public function cardHeader(): array
    {
        return ['card-header'];
    }

    public function cardBody(): array
    {
        return ['card-body'];
    }

    public function cardFooter(): array
    {
        return ['card-footer', 'text-body-secondary'];
    }

    public function cardImage(): array
    {
        return ['card-img-top'];
    }

    public function alert(string $variant): array
    {
        return ['alert', "alert-{$this->bsVariant($variant)}", 'd-flex', 'align-items-start', 'gap-2', 'mb-2'];
    }

    public function alertTitle(): array
    {
        return ['fw-semibold'];
    }

    public function alertBody(): array
    {
        return ['flex-grow-1'];
    }

    public function alertDismiss(): array
    {
        return ['btn-close'];
    }

    public function table(): array
    {
        return ['table'];
    }

    public function tableStriped(): array
    {
        return ['table-striped'];
    }

    public function tableBordered(): array
    {
        return ['table-bordered'];
    }

    public function tableHoverable(): array
    {
        return ['table-hover'];
    }

    public function tableCompact(): array
    {
        return ['table-sm'];
    }

    public function tableResponsive(): array
    {
        return ['table-responsive'];
    }

    public function tableHeader(): array
    {
        return [];
    }

    public function tableHeaderCell(): array
    {
        return [];
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
        return [];
    }

    public function tableCaption(): array
    {
        return ['caption-top'];
    }

    public function formGroup(): array
    {
        return ['mb-3'];
    }

    public function formLabel(): array
    {
        return ['form-label'];
    }

    public function formInput(): array
    {
        return ['form-control'];
    }

    public function formSelect(): array
    {
        return ['form-select'];
    }

    public function formTextarea(): array
    {
        return ['form-control'];
    }

    public function formCheckbox(): array
    {
        return ['form-check'];
    }

    public function formRadio(): array
    {
        return ['form-check', 'form-check-inline'];
    }

    public function formRow(): array
    {
        return ['row', 'g-3'];
    }

    public function formRowItem(): array
    {
        return ['col'];
    }

    public function buttonPrimary(): array
    {
        return ['btn', 'btn-primary'];
    }

    public function buttonSecondary(): array
    {
        return ['btn', 'btn-secondary'];
    }

    public function button(?string $variant): array
    {
        return ['btn', "btn-{$this->bsVariant($variant)}"];
    }

    public function navbar(?string $variant): array
    {
        $classes = ['navbar', 'navbar-expand'];
        if ($variant === 'dark') {
            $classes = array_merge($classes, ['navbar-dark', 'bg-dark']);
        } elseif ($variant === 'primary') {
            $classes = array_merge($classes, ['navbar-dark', 'bg-primary']);
        } else {
            $classes = array_merge($classes, ['navbar-light', 'bg-light']);
        }
        return $classes;
    }

    public function navbarBrand(): array
    {
        return ['navbar-brand'];
    }

    public function navbarLinks(): array
    {
        return ['navbar-nav', 'flex-row', 'gap-3'];
    }

    public function navbarLink(bool $active): array
    {
        $classes = ['nav-link'];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
    }

    public function sidebar(?string $variant): array
    {
        return ['d-flex', 'flex-column', 'flex-shrink-0', 'bg-body-tertiary', 'border-end'];
    }

    public function sidebarHeader(): array
    {
        return ['p-3', 'border-bottom'];
    }

    public function sidebarItem(bool $active): array
    {
        $classes = ['nav-link', 'px-3', 'py-2'];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
    }

    public function sidebarDivider(): array
    {
        return ['dropdown-divider', 'mx-3'];
    }

    public function sidebarHeading(): array
    {
        return ['px-3', 'pt-3', 'pb-1', 'text-uppercase', 'small', 'text-muted'];
    }

    public function modalOverlay(): array
    {
        return ['modal'];
    }

    public function modalDialog(string $size, bool $centered): array
    {
        $classes = ['modal-dialog'];
        if ($centered) {
            $classes[] = 'modal-dialog-centered';
        }
        if ($size === 'small') {
            $classes[] = 'modal-sm';
        } elseif ($size === 'large') {
            $classes[] = 'modal-lg';
        } elseif ($size === 'fullscreen') {
            $classes[] = 'modal-fullscreen';
        }
        return $classes;
    }

    public function modalHeader(): array
    {
        return ['modal-header'];
    }

    public function modalBody(): array
    {
        return ['modal-body'];
    }

    public function modalFooter(): array
    {
        return ['modal-footer'];
    }

    public function modalClose(): array
    {
        return ['btn-close'];
    }

    public function modalContent(): array
    {
        return ['modal-content'];
    }

    public function modalShowScript(string $id): string
    {
        return "new bootstrap.Modal(document.getElementById('{$id}')).show()";
    }

    public function modalHideScript(string $id): string
    {
        return "bootstrap.Modal.getInstance(document.getElementById('{$id}')).hide()";
    }

    public function externalJsUrls(): array
    {
        return ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js'];
    }

    public function list(string $type, bool $styled): array
    {
        return $styled ? [] : ['list-unstyled'];
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
        return ['nav', 'nav-tabs', 'mb-3'];
    }

    public function tabButton(bool $active): array
    {
        $classes = ['nav-link'];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
    }

    public function tabContent(): array
    {
        return ['tab-pane'];
    }

    public function pageBody(): array
    {
        return [];
    }

    public function pageTitle(): array
    {
        return ['mb-4'];
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
        return ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css'];
    }

    protected function bsVariant(?string $variant): string
    {
        if ($variant === null) {
            return 'primary';
        }
        return match ($variant) {
            'info' => 'info',
            'success' => 'success',
            'warning' => 'warning',
            'danger' => 'danger',
            'primary' => 'primary',
            'secondary' => 'secondary',
            default => 'primary',
        };
    }

    public function resolveUtility(string $category, array $params): ?string
    {
        return match ($category) {
            'spacing' => $this->resolveSpacing(
                $params['property'] ?? 'margin',
                $params['side'] ?? null,
                $params['size'] ?? '0',
                $params['breakpoint'] ?? null
            ),
            'gap' => $this->resolveGap($params['size'] ?? '0', $params['breakpoint'] ?? null),
            'display' => $this->resolveDisplay($params['value'] ?? 'block', $params['breakpoint'] ?? null),
            'flexDirection' => $this->resolveFlexDirection($params['value'] ?? 'row'),
            'flexWrap' => $this->resolveFlexWrap($params['value'] ?? 'wrap'),
            'alignItems' => 'align-items-' . $params['value'],
            'justifyContent' => 'justify-content-' . $params['value'],
            'text' => $this->resolveText($params['property'] ?? 'align', $params['value'] ?? ''),
            'background' => $this->resolveBackground($params['value'] ?? '', $params['gradient'] ?? null),
            'bgOpacity' => 'bg-opacity-' . $params['value'],
            'border' => $this->resolveBorder($params['value'] ?? '', $params['side'] ?? null),
            'borderRadius' => $this->resolveBorderRadius($params['value'] ?? '', $params['side'] ?? null),
            'width' => 'w-' . $params['value'],
            'height' => 'h-' . $params['value'],
            'maxWidth' => 'mw-' . $params['value'],
            'maxHeight' => 'mh-' . $params['value'],
            'viewportWidth' => 'vw-' . $params['value'],
            'viewportHeight' => 'vh-' . $params['value'],
            'position' => 'position-' . $params['value'],
            'top' => 'top-' . $params['value'],
            'bottom' => 'bottom-' . $params['value'],
            'start' => 'start-' . $params['value'],
            'end' => 'end-' . $params['value'],
            'overflow' => 'overflow-' . $params['value'],
            'shadow' => $this->resolveShadow($params['value'] ?? null),
            'opacity' => 'opacity-' . $params['value'],
            'zIndex' => 'z-' . $params['value'],
            'float' => $this->resolveWithBreakpoint('float', $params['value'], $params['breakpoint'] ?? null),
            'clear' => 'clearfix',
            'cursor' => 'cursor-' . $params['value'],
            'userSelect' => 'user-select-' . $params['value'],
            'pointerEvents' => 'pe-' . $params['value'],
            'visibility' => $params['value'],
            'order' => 'order-' . $params['value'],
            'col' => $this->resolveCol($params['value'] ?? '', $params['breakpoint'] ?? null),
            'offset' => $this->resolveOffset($params['value'] ?? '0', $params['breakpoint'] ?? null),
            default => null,
        };
    }

    protected function resolveSpacing(string $property, ?string $side, string $size, ?string $breakpoint): string
    {
        $prefix = $property === 'margin' ? 'm' : 'p';
        $sideMap = [
            'top' => 't', 'bottom' => 'b',
            'start' => 's', 'end' => 'e',
            'x' => 'x', 'y' => 'y',
        ];
        if ($side && isset($sideMap[$side])) {
            $prefix .= $sideMap[$side];
        }
        if ($breakpoint) {
            return "{$prefix}-{$breakpoint}-{$size}";
        }
        return "{$prefix}-{$size}";
    }

    protected function resolveGap(string $size, ?string $breakpoint): string
    {
        if ($breakpoint) {
            return "gap-{$breakpoint}-{$size}";
        }
        return "gap-{$size}";
    }

    protected function resolveDisplay(string $value, ?string $breakpoint): string
    {
        $map = [
            'none' => 'd-none', 'inline' => 'd-inline', 'inline-block' => 'd-inline-block',
            'block' => 'd-block', 'grid' => 'd-grid', 'flex' => 'd-flex',
            'inline-flex' => 'd-inline-flex', 'table' => 'd-table', 'table-cell' => 'd-table-cell',
            'table-row' => 'd-table-row',
        ];
        $base = $map[$value] ?? 'd-' . $value;
        if ($breakpoint) {
            $base = str_replace('d-', "d-{$breakpoint}-", $base);
        }
        return $base;
    }

    protected function resolveFlexDirection(string $value): string
    {
        $map = [
            'row' => 'flex-row', 'column' => 'flex-column',
            'row-reverse' => 'flex-row-reverse', 'column-reverse' => 'flex-column-reverse',
        ];
        return $map[$value] ?? 'flex-' . $value;
    }

    protected function resolveFlexWrap(string $value): string
    {
        $map = [
            'wrap' => 'flex-wrap', 'nowrap' => 'flex-nowrap', 'reverse' => 'flex-wrap-reverse',
        ];
        return $map[$value] ?? 'flex-' . $value;
    }

    protected function resolveText(string $property, string $value): string
    {
        return match ($property) {
            'align' => 'text-' . $value,
            'color' => 'text-' . $value,
            'size' => 'fs-' . $value,
            'weight' => 'fw-' . $value,
            'transform' => 'text-' . $value,
            'decoration' => 'text-decoration-' . $value,
            'wrap' => 'text-' . $value,
            'opacity' => 'text-opacity-' . $value,
            default => 'text-' . $value,
        };
    }

    protected function resolveBackground(string $value, ?string $gradient): string
    {
        if ($gradient) {
            return "bg-{$value} bg-gradient";
        }
        return "bg-{$value}";
    }

    protected function resolveBorder(string $value, ?string $side): string
    {
        $sideMap = [
            'top' => 'top', 'bottom' => 'bottom',
            'start' => 'start', 'end' => 'end',
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

    protected function resolveBorderRadius(string $value, ?string $side): string
    {
        $sideMap = [
            'top' => 'top', 'bottom' => 'bottom',
            'start' => 'start', 'end' => 'end',
        ];
        if ($value === 'circle') return 'rounded-circle';
        if ($value === 'pill') return 'rounded-pill';
        if ($value === '0') return 'rounded-0';
        if ($value === '1') return 'rounded-1';
        if ($value === '2') return 'rounded-2';
        if ($value === '3') return 'rounded-3';
        if ($value === '4') return 'rounded-4';
        if ($value === '5') return 'rounded-5';
        if ($side && isset($sideMap[$side])) {
            return "rounded-{$sideMap[$side]}";
        }
        return 'rounded';
    }

    protected function resolveShadow(?string $value): string
    {
        return match ($value) {
            null, '' => 'shadow',
            'none' => 'shadow-none',
            'sm' => 'shadow-sm',
            'lg' => 'shadow-lg',
            default => 'shadow',
        };
    }

    protected function resolveWithBreakpoint(string $prefix, string $value, ?string $breakpoint): string
    {
        if ($breakpoint) {
            return "{$prefix}-{$breakpoint}-{$value}";
        }
        return "{$prefix}-{$value}";
    }

    protected function resolveCol(string $value, ?string $breakpoint): string
    {
        if ($breakpoint) {
            return $value ? "col-{$breakpoint}-{$value}" : "col-{$breakpoint}";
        }
        return $value ? "col-{$value}" : "col";
    }

    protected function resolveOffset(string $value, ?string $breakpoint): string
    {
        if ($breakpoint) {
            return "offset-{$breakpoint}-{$value}";
        }
        return "offset-{$value}";
    }

    public function accordion(): array
    {
        return ['accordion'];
    }

    public function accordionItem(bool $open): array
    {
        return ['accordion-item'];
    }

    public function accordionHeader(): array
    {
        return ['accordion-header'];
    }

    public function accordionButton(bool $collapsed): array
    {
        $classes = ['accordion-button'];
        if (!$collapsed) {
            $classes[] = 'collapsed';
        }
        return $classes;
    }

    public function accordionCollapse(): array
    {
        return ['accordion-collapse'];
    }

    public function accordionBody(): array
    {
        return ['accordion-body'];
    }

    public function breadcrumb(): array
    {
        return ['breadcrumb'];
    }

    public function breadcrumbItem(bool $active): array
    {
        $classes = ['breadcrumb-item'];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
    }

    public function badge(?string $variant, bool $pill): array
    {
        $classes = ['badge'];
        if ($variant) {
            $classes[] = "bg-{$this->bsVariant($variant)}";
        }
        if ($pill) {
            $classes[] = 'rounded-pill';
        }
        return $classes;
    }

    public function buttonGroup(?string $size): array
    {
        $classes = ['btn-group'];
        if ($size === 'small') {
            $classes[] = 'btn-group-sm';
        } elseif ($size === 'large') {
            $classes[] = 'btn-group-lg';
        }
        return $classes;
    }

    public function buttonToolbar(): array
    {
        return ['btn-toolbar'];
    }

    public function carousel(): array
    {
        return ['carousel', 'slide'];
    }

    public function carouselInner(): array
    {
        return ['carousel-inner'];
    }

    public function carouselItem(bool $active): array
    {
        $classes = ['carousel-item'];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
    }

    public function carouselIndicator(bool $active): array
    {
        if ($active) {
            return ['active'];
        }
        return [];
    }

    public function carouselControl(string $direction): array
    {
        return ["carousel-control-{$direction}"];
    }

    public function collapse(): array
    {
        return ['collapse'];
    }

    public function dropdown(): array
    {
        return ['dropdown'];
    }

    public function dropdownMenu(): array
    {
        return ['dropdown-menu'];
    }

    public function dropdownItem(bool $active, bool $disabled): array
    {
        $classes = ['dropdown-item'];
        if ($active) {
            $classes[] = 'active';
        }
        if ($disabled) {
            $classes[] = 'disabled';
        }
        return $classes;
    }

    public function dropdownDivider(): array
    {
        return ['dropdown-divider'];
    }

    public function dropdownHeader(): array
    {
        return ['dropdown-header'];
    }

    public function offcanvas(string $placement): array
    {
        return ['offcanvas', "offcanvas-{$placement}"];
    }

    public function offcanvasHeader(): array
    {
        return ['offcanvas-header'];
    }

    public function offcanvasBody(): array
    {
        return ['offcanvas-body'];
    }

    public function offcanvasShowScript(string $id): string
    {
        return "new bootstrap.Offcanvas(document.getElementById('{$id}')).show()";
    }

    public function offcanvasHideScript(string $id): string
    {
        return "bootstrap.Offcanvas.getInstance(document.getElementById('{$id}')).hide()";
    }

    public function pagination(): array
    {
        return ['pagination'];
    }

    public function paginationItem(bool $active, bool $disabled): array
    {
        $classes = ['page-item'];
        if ($active) {
            $classes[] = 'active';
        }
        if ($disabled) {
            $classes[] = 'disabled';
        }
        return $classes;
    }

    public function paginationLink(bool $active, bool $disabled): array
    {
        return ['page-link'];
    }

    public function placeholder(): array
    {
        return ['placeholder'];
    }

    public function placeholderCol(int $size): array
    {
        return ['placeholder-glow', "col-{$size}"];
    }

    public function popover(): array
    {
        return [];
    }

    public function progress(): array
    {
        return ['progress'];
    }

    public function progressBar(?string $variant, bool $striped, bool $animated): array
    {
        $classes = ['progress-bar'];
        if ($variant) {
            $classes[] = "bg-{$this->bsVariant($variant)}";
        }
        if ($striped) {
            $classes[] = 'progress-bar-striped';
        }
        if ($animated) {
            $classes[] = 'progress-bar-animated';
        }
        return $classes;
    }

    public function spinner(?string $variant, string $type): array
    {
        $classes = $type === 'grow' ? ['spinner-grow'] : ['spinner-border'];
        if ($variant) {
            $classes[] = "text-{$this->bsVariant($variant)}";
        }
        return $classes;
    }

    public function toast(): array
    {
        return ['toast'];
    }

    public function toastHeader(): array
    {
        return ['toast-header'];
    }

    public function toastBody(): array
    {
        return ['toast-body'];
    }

    public function tooltip(): array
    {
        return [];
    }
}
