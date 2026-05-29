<?php

namespace BagasTopati\UiCore\CssFrameworks;

use BagasTopati\UiCore\Contracts\CssFramework;

class Bootstrap5Framework implements CssFramework
{
    public function name(): string
    {
        return 'bootstrap5';
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
        return ['form-check'];
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

    public function buttonSpacing(): array
    {
        return ['me-2'];
    }

    public function navbar(?string $variant): array
    {
        $classes = ['navbar', 'navbar-expand-lg'];
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

    public function sidebar(string $variant): array
    {
        return ['sidebar', "sidebar-{$variant}"];
    }

    public function sidebarHeader(): array
    {
        return ['sidebar-header'];
    }

    public function sidebarItem(bool $active): array
    {
        $classes = ['nav-item'];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
    }

    public function sidebarDivider(): array
    {
        return ['sidebar-divider'];
    }

    public function sidebarHeading(): array
    {
        return ['sidebar-heading'];
    }

    public function modalOverlay(): array
    {
        return ['modal', 'd-block'];
    }

    public function modalDialog(string $size, bool $centered): array
    {
        $classes = ['modal-dialog'];
        if ($size === 'large') {
            $classes[] = 'modal-lg';
        } elseif ($size === 'small') {
            $classes[] = 'modal-sm';
        } elseif ($size === 'extra-large') {
            $classes[] = 'modal-xl';
        }
        if ($centered) {
            $classes[] = 'modal-dialog-centered';
        }
        return $classes;
    }

    public function modalContent(): array
    {
        return ['modal-content'];
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

    public function modalShowScript(string $id): string
    {
        return "new bootstrap.Modal(document.getElementById('$id')).show();";
    }

    public function modalHideScript(string $id): string
    {
        return "new bootstrap.Modal(document.getElementById('$id')).hide();";
    }

    public function list(string $type, bool $styled): array
    {
        return ['list-' . ($type === 'ordered' ? 'ol' : 'ul')];
    }

    public function listItem(): array
    {
        return [];
    }

    public function tabsContainer(): array
    {
        return ['nav-tabs'];
    }

    public function tabsNav(): array
    {
        return ['nav', 'nav-tabs'];
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
        return ['tab-content'];
    }

    public function pageBody(): array
    {
        return [];
    }

    public function pageTitle(): array
    {
        return [];
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
        return [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        ];
    }

    public function externalJsUrls(): array
    {
        return [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        ];
    }

    public function resolveUtility(string $category, array $params): ?string
    {
        return null;
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
        if ($collapsed) {
            $classes[] = 'collapsed';
        }
        return $classes;
    }

    public function accordionCollapse(): array
    {
        return ['accordion-collapse', 'collapse'];
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
        $classes = ['badge', "bg-{$this->bsVariant($variant)}"];
        if ($pill) {
            $classes[] = 'rounded-pill';
        }
        return $classes;
    }

    public function buttonGroup(?string $size): array
    {
        $classes = ['btn-group'];
        if ($size) {
            $classes[] = "btn-group-{$size}";
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
        $classes = [];
        if ($active) {
            $classes[] = 'active';
        }
        return $classes;
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
        return "new bootstrap.Offcanvas(document.getElementById('$id')).show();";
    }

    public function offcanvasHideScript(string $id): string
    {
        return "new bootstrap.Offcanvas(document.getElementById('$id')).hide();";
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
        $classes = ['page-link'];
        return $classes;
    }

    public function placeholder(): array
    {
        return ['placeholder', 'col-12'];
    }

    public function placeholderCol(int $size): array
    {
        return ["col-{$size}"];
    }

    public function popover(): array
    {
        return ['popover'];
    }

    public function progress(): array
    {
        return ['progress'];
    }

    public function progressBar(?string $variant, bool $striped, bool $animated): array
    {
        $classes = ['progress-bar', "bg-{$this->bsVariant($variant)}"];
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
        $classes = ['spinner-' . ($type === 'border' ? 'border' : 'grow')];
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
        return ['tooltip'];
    }

    protected function bsVariant(string $variant): string
    {
        return match ($variant) {
            'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark' => $variant,
            'error' => 'danger',
            'warn' => 'warning',
            default => 'secondary',
        };
    }
}
