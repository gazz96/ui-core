<?php

namespace BagasTopati\UiCore\CssFrameworks;

use BagasTopati\UiCore\Contracts\CssFramework;

class DefaultFramework implements CssFramework
{
    public function name(): string
    {
        return 'default';
    }

    public function grid(int $columns, string $gap): array
    {
        return ['ui-grid', "ui-grid-cols-{$columns}", "ui-gap-{$this->gapClass($gap)}"];
    }

    public function flexRow(string $gap): array
    {
        return ['ui-flex', 'ui-flex-row', "ui-gap-{$this->gapClass($gap)}"];
    }

    public function flexCol(string $gap): array
    {
        return ['ui-flex', 'ui-flex-col', "ui-gap-{$this->gapClass($gap)}"];
    }

    public function flexCenter(): array
    {
        return ['ui-flex-center'];
    }

    public function flexBetween(): array
    {
        return ['ui-flex-between'];
    }

    public function flexWrap(): array
    {
        return ['ui-flex-wrap'];
    }

    public function container(bool $fluid, ?string $maxWidth): array
    {
        if ($fluid) {
            return ['ui-container', 'ui-container-fluid'];
        }
        return ['ui-container'];
    }

    public function card(?string $variant): array
    {
        $classes = ['ui-card'];
        if ($variant) {
            $classes[] = "ui-card-{$variant}";
        }
        return $classes;
    }

    public function cardHeader(): array
    {
        return ['ui-card-header'];
    }

    public function cardBody(): array
    {
        return ['ui-card-body'];
    }

    public function cardFooter(): array
    {
        return ['ui-card-footer'];
    }

    public function cardImage(): array
    {
        return ['ui-card-image'];
    }

    public function alert(string $variant): array
    {
        return ['ui-alert', "ui-alert-{$variant}"];
    }

    public function alertTitle(): array
    {
        return ['ui-alert-title'];
    }

    public function alertBody(): array
    {
        return ['ui-alert-body'];
    }

    public function alertDismiss(): array
    {
        return ['ui-alert-dismiss'];
    }

    public function table(): array
    {
        return ['ui-table'];
    }

    public function tableStriped(): array
    {
        return ['ui-table-striped'];
    }

    public function tableBordered(): array
    {
        return ['ui-table-bordered'];
    }

    public function tableHoverable(): array
    {
        return ['ui-table-hover'];
    }

    public function tableCompact(): array
    {
        return ['ui-table-compact'];
    }

    public function tableResponsive(): array
    {
        return ['ui-table-responsive'];
    }

    public function tableHeader(): array
    {
        return [];
    }

    public function tableHeaderCell(): array
    {
        return ['ui-table-th'];
    }

    public function tableBody(): array
    {
        return [];
    }

    public function tableRow(int $rowIndex, bool $striped): array
    {
        return ['ui-table-tr'];
    }

    public function tableCell(): array
    {
        return ['ui-table-td'];
    }

    public function tableCaption(): array
    {
        return ['ui-table-caption'];
    }

    public function formGroup(): array
    {
        return ['ui-form-group'];
    }

    public function formLabel(): array
    {
        return ['ui-form-label'];
    }

    public function formInput(): array
    {
        return ['ui-form-input'];
    }

    public function formSelect(): array
    {
        return ['ui-form-select'];
    }

    public function formTextarea(): array
    {
        return ['ui-form-textarea'];
    }

    public function formCheckbox(): array
    {
        return ['ui-form-checkbox'];
    }

    public function formRadio(): array
    {
        return ['ui-form-radio'];
    }

    public function formRow(): array
    {
        return ['ui-form-row'];
    }

    public function formRowItem(): array
    {
        return ['ui-form-row-item'];
    }

    public function buttonPrimary(): array
    {
        return ['ui-btn', 'ui-btn-primary'];
    }

    public function buttonSecondary(): array
    {
        return ['ui-btn', 'ui-btn-secondary'];
    }

    public function button(?string $variant): array
    {
        return ['ui-btn', "ui-btn-" . ($variant ?? 'primary')];
    }

    public function navbar(?string $variant): array
    {
        $classes = ['ui-navbar'];
        if ($variant) {
            $classes[] = "ui-navbar-{$variant}";
        }
        return $classes;
    }

    public function navbarBrand(): array
    {
        return ['ui-navbar-brand'];
    }

    public function navbarLinks(): array
    {
        return ['ui-navbar-links'];
    }

    public function navbarLink(bool $active): array
    {
        $classes = ['ui-navbar-link'];
        if ($active) {
            $classes[] = 'ui-navbar-link-active';
        }
        return $classes;
    }

    public function sidebar(?string $variant): array
    {
        $classes = ['ui-sidebar'];
        if ($variant) {
            $classes[] = "ui-sidebar-{$variant}";
        }
        return $classes;
    }

    public function sidebarHeader(): array
    {
        return ['ui-sidebar-header'];
    }

    public function sidebarItem(bool $active): array
    {
        $classes = ['ui-sidebar-item'];
        if ($active) {
            $classes[] = 'ui-sidebar-item-active';
        }
        return $classes;
    }

    public function sidebarDivider(): array
    {
        return ['ui-sidebar-divider'];
    }

    public function sidebarHeading(): array
    {
        return ['ui-sidebar-heading'];
    }

    public function modalOverlay(): array
    {
        return ['ui-modal-overlay'];
    }

    public function modalDialog(string $size, bool $centered): array
    {
        $classes = ['ui-modal-dialog', "ui-modal-{$size}"];
        if ($centered) {
            $classes[] = 'ui-modal-centered';
        }
        return $classes;
    }

    public function modalContent(): array
    {
        return ['ui-modal-content'];
    }

    public function modalHeader(): array
    {
        return ['ui-modal-header'];
    }

    public function modalBody(): array
    {
        return ['ui-modal-body'];
    }

    public function modalFooter(): array
    {
        return ['ui-modal-footer'];
    }

    public function modalClose(): array
    {
        return ['ui-modal-close'];
    }

    public function modalShowScript(string $id): string
    {
        return "document.getElementById('{$id}').style.display='flex'";
    }

    public function modalHideScript(string $id): string
    {
        return "document.getElementById('{$id}').style.display='none'";
    }

    public function list(string $type, bool $styled): array
    {
        $classes = ['ui-list'];
        if (!$styled) {
            $classes[] = 'ui-list-unstyled';
        }
        return $classes;
    }

    public function listItem(): array
    {
        return ['ui-list-item'];
    }

    public function tabsContainer(): array
    {
        return ['ui-tabs'];
    }

    public function tabsNav(): array
    {
        return ['ui-tabs-nav'];
    }

    public function tabButton(bool $active): array
    {
        $classes = ['ui-tab-btn'];
        if ($active) {
            $classes[] = 'ui-tab-btn-active';
        }
        return $classes;
    }

    public function tabContent(): array
    {
        return ['ui-tab-content'];
    }

    public function pageBody(): array
    {
        return ['ui-page'];
    }

    public function pageTitle(): array
    {
        return ['ui-page-title'];
    }

    public function requiresExternalCss(): bool
    {
        return false;
    }

    public function externalCssUrls(): array
    {
        return [];
    }

    public function externalJsUrls(): array
    {
        return [];
    }

    public function resolveUtility(string $category, array $params): ?string
    {
        return null;
    }

    public function accordion(): array
    {
        return ['ui-accordion'];
    }

    public function accordionItem(bool $open): array
    {
        return ['ui-accordion-item'];
    }

    public function accordionHeader(): array
    {
        return ['ui-accordion-header'];
    }

    public function accordionButton(bool $collapsed): array
    {
        return ['ui-accordion-button'];
    }

    public function accordionCollapse(): array
    {
        return ['ui-accordion-collapse'];
    }

    public function accordionBody(): array
    {
        return ['ui-accordion-body'];
    }

    public function breadcrumb(): array
    {
        return ['ui-breadcrumb'];
    }

    public function breadcrumbItem(bool $active): array
    {
        $classes = ['ui-breadcrumb-item'];
        if ($active) {
            $classes[] = 'ui-breadcrumb-active';
        }
        return $classes;
    }

    public function badge(?string $variant, bool $pill): array
    {
        $classes = ['ui-badge'];
        if ($variant) {
            $classes[] = "ui-badge-{$variant}";
        }
        if ($pill) {
            $classes[] = 'ui-badge-pill';
        }
        return $classes;
    }

    public function buttonGroup(?string $size): array
    {
        return ['ui-btn-group'];
    }

    public function buttonToolbar(): array
    {
        return ['ui-btn-toolbar'];
    }

    public function carousel(): array
    {
        return ['ui-carousel'];
    }

    public function carouselInner(): array
    {
        return ['ui-carousel-inner'];
    }

    public function carouselItem(bool $active): array
    {
        return ['ui-carousel-item'];
    }

    public function carouselIndicator(bool $active): array
    {
        return $active ? ['ui-carousel-indicator-active'] : [];
    }

    public function carouselControl(string $direction): array
    {
        return ["ui-carousel-control-{$direction}"];
    }

    public function collapse(): array
    {
        return ['ui-collapse'];
    }

    public function dropdown(): array
    {
        return ['ui-dropdown'];
    }

    public function dropdownMenu(): array
    {
        return ['ui-dropdown-menu'];
    }

    public function dropdownItem(bool $active, bool $disabled): array
    {
        $classes = ['ui-dropdown-item'];
        if ($active) {
            $classes[] = 'ui-dropdown-active';
        }
        if ($disabled) {
            $classes[] = 'ui-dropdown-disabled';
        }
        return $classes;
    }

    public function dropdownDivider(): array
    {
        return ['ui-dropdown-divider'];
    }

    public function dropdownHeader(): array
    {
        return ['ui-dropdown-header'];
    }

    public function offcanvas(string $placement): array
    {
        return ['ui-offcanvas'];
    }

    public function offcanvasHeader(): array
    {
        return ['ui-offcanvas-header'];
    }

    public function offcanvasBody(): array
    {
        return ['ui-offcanvas-body'];
    }

    public function offcanvasShowScript(string $id): string
    {
        return "document.getElementById('{$id}').style.display='block'";
    }

    public function offcanvasHideScript(string $id): string
    {
        return "document.getElementById('{$id}').style.display='none'";
    }

    public function pagination(): array
    {
        return ['ui-pagination'];
    }

    public function paginationItem(bool $active, bool $disabled): array
    {
        $classes = ['ui-pagination-item'];
        if ($active) {
            $classes[] = 'ui-pagination-active';
        }
        if ($disabled) {
            $classes[] = 'ui-pagination-disabled';
        }
        return $classes;
    }

    public function paginationLink(bool $active, bool $disabled): array
    {
        return ['ui-pagination-link'];
    }

    public function placeholder(): array
    {
        return ['ui-placeholder'];
    }

    public function placeholderCol(int $size): array
    {
        return ['ui-placeholder-col'];
    }

    public function popover(): array
    {
        return ['ui-popover'];
    }

    public function progress(): array
    {
        return ['ui-progress'];
    }

    public function progressBar(?string $variant, bool $striped, bool $animated): array
    {
        $classes = ['ui-progress-bar'];
        if ($variant) {
            $classes[] = "ui-progress-bar-{$variant}";
        }
        return $classes;
    }

    public function spinner(?string $variant, string $type): array
    {
        $classes = ['ui-spinner'];
        if ($type === 'grow') {
            $classes[] = 'ui-spinner-grow';
        }
        return $classes;
    }

    public function toast(): array
    {
        return ['ui-toast'];
    }

    public function toastHeader(): array
    {
        return ['ui-toast-header'];
    }

    public function toastBody(): array
    {
        return ['ui-toast-body'];
    }

    public function tooltip(): array
    {
        return ['ui-tooltip'];
    }

    protected function gapClass(string $gap): string
    {
        $map = [
            '0px' => '0', '4px' => '1', '8px' => '2', '12px' => '3',
            '16px' => '4', '20px' => '5', '24px' => '6', '32px' => '8',
        ];
        return $map[$gap] ?? '4';
    }

    public function generateStylesheet(): string
    {
        return <<<'CSS'
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
.ui-page{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;line-height:1.5;color:#1f2937;background:#fff}
.ui-page-title{margin-bottom:24px;font-size:1.5rem}

.ui-container{margin:0 auto;max-width:1200px;padding:0 24px}
.ui-container-fluid{max-width:100%}

.ui-flex{display:flex}.ui-flex-row{flex-direction:row}.ui-flex-col{flex-direction:column}
.ui-flex-center{display:flex;align-items:center;justify-content:center}
.ui-flex-between{display:flex;align-items:center;justify-content:space-between}
.ui-flex-wrap{flex-wrap:wrap}
.ui-gap-0{gap:0}.ui-gap-1{gap:4px}.ui-gap-2{gap:8px}.ui-gap-3{gap:12px}
.ui-gap-4{gap:16px}.ui-gap-5{gap:20px}.ui-gap-6{gap:24px}.ui-gap-8{gap:32px}

.ui-grid{display:grid}
.ui-grid-cols-1{grid-template-columns:repeat(1,1fr)}.ui-grid-cols-2{grid-template-columns:repeat(2,1fr)}
.ui-grid-cols-3{grid-template-columns:repeat(3,1fr)}.ui-grid-cols-4{grid-template-columns:repeat(4,1fr)}
.ui-grid-cols-5{grid-template-columns:repeat(5,1fr)}.ui-grid-cols-6{grid-template-columns:repeat(6,1fr)}

.ui-card{border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.1)}
.ui-card-primary{border-left:4px solid #3b82f6;background:#eff6ff}
.ui-card-success{border-left:4px solid #22c55e;background:#f0fdf4}
.ui-card-warning{border-left:4px solid #f59e0b;background:#fffbeb}
.ui-card-danger{border-left:4px solid #ef4444;background:#fef2f2}
.ui-card-info{border-left:4px solid #06b6d4;background:#ecfeff}
.ui-card-image{width:100%;display:block}
.ui-card-body{padding:16px}
.ui-card-body small{color:#6b7280;text-transform:uppercase;font-size:0.75rem;letter-spacing:0.05em}
.ui-card-body h2{margin:4px 0 0 0;font-size:1.5rem}
.ui-card-body p{margin:4px 0 0 0;color:#6b7280;font-size:0.875rem}
.ui-card-footer{padding:12px 16px;border-top:1px solid #e5e7eb;background:#f9fafb;font-size:0.875rem;color:#6b7280}

.ui-alert{padding:12px 16px;border-radius:8px;margin-bottom:8px;display:flex;align-items:flex-start;gap:8px}
.ui-alert-info{border-left:4px solid #3b82f6;background:#eff6ff;color:#1e40af}
.ui-alert-success{border-left:4px solid #22c55e;background:#f0fdf4;color:#166534}
.ui-alert-warning{border-left:4px solid #f59e0b;background:#fffbeb;color:#92400e}
.ui-alert-danger{border-left:4px solid #ef4444;background:#fef2f2;color:#991b1b}
.ui-alert-title{display:block;margin-bottom:4px;font-weight:600}
.ui-alert-body{flex:1}
.ui-alert-dismiss{background:none;border:none;font-size:1.2rem;cursor:pointer;padding:0;line-height:1}

.ui-table{border-collapse:collapse;width:100%}
.ui-table th{padding:10px 16px;text-align:left;background:#f5f5f5;border-bottom:2px solid #ddd;font-weight:600}
.ui-table td{padding:10px 16px;border-bottom:1px solid #eee}
.ui-table-striped tr:nth-child(even) td{background:#f9f9f9}
.ui-table-bordered th,.ui-table-bordered td{border:1px solid #ddd}
.ui-table-hover tr:hover td{background:#f0f7ff}
.ui-table-compact th,.ui-table-compact td{padding:6px 10px}
.ui-table-responsive{overflow-x:auto}
.ui-table-caption{text-align:left;padding:8px;font-weight:600}
.ui-table-actions{white-space:nowrap}
.ui-table-actions a{margin-right:8px;text-decoration:none}
.ui-table-empty{text-align:center;color:#999}
.ui-table-badge{padding:2px 10px;border-radius:999px;font-size:0.8rem}
.ui-table-badge-success{background:#dcfce7;color:#166534}
.ui-table-badge-danger{background:#fee2e2;color:#991b1b}

.ui-form-group{margin-bottom:16px}
.ui-form-label{display:block;margin-bottom:4px;font-weight:500;font-size:0.875rem}
.ui-form-input,.ui-form-select,.ui-form-textarea{display:block;width:100%;padding:8px 12px;border:1px solid #d1d5db;border-radius:6px;font-size:0.9375rem;font-family:inherit;background:#fff}
.ui-form-input:focus,.ui-form-select:focus,.ui-form-textarea:focus{outline:none;border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,0.1)}
.ui-form-row{display:flex;gap:12px}
.ui-form-row-item{flex:1}
.ui-form-checkbox label,.ui-form-radio label{display:inline-flex;align-items:center;gap:4px;font-weight:400;cursor:pointer}
.ui-form-checkbox input,.ui-form-radio input{margin-right:4px}
fieldset{border:1px solid #d1d5db;border-radius:6px;padding:16px;margin-bottom:16px}
legend{font-weight:600;padding:0 4px}

.ui-btn{padding:8px 16px;border:1px solid transparent;border-radius:6px;font-size:0.9375rem;cursor:pointer;font-family:inherit}
.ui-btn-primary{background:#3b82f6;color:#fff}.ui-btn-primary:hover{background:#2563eb}
.ui-btn-secondary{background:#e5e7eb;color:#374151}
.ui-btn-success{background:#22c55e;color:#fff}.ui-btn-success:hover{background:#16a34a}
.ui-btn-danger{background:#ef4444;color:#fff}.ui-btn-danger:hover{background:#dc2626}
.ui-btn-warning{background:#f59e0b;color:#fff}.ui-btn-warning:hover{background:#d97706}

.ui-navbar{display:flex;align-items:center;justify-content:space-between;padding:12px 24px;box-shadow:0 1px 3px rgba(0,0,0,0.1);position:sticky;top:0;z-index:1000;background:#fff;color:#374151}
.ui-navbar-dark{background:#1f2937;color:#fff}
.ui-navbar-primary{background:#3b82f6;color:#fff}
.ui-navbar-brand{font-weight:700;font-size:1.125rem;text-decoration:none;color:inherit}
.ui-navbar-links{display:flex;align-items:center;gap:24px}
.ui-navbar-link{text-decoration:none;color:inherit;padding:6px 12px;border-radius:4px}
.ui-navbar-link-active{background:rgba(255,255,255,0.15)}
.ui-navbar-dark .ui-navbar-link-active{background:#374151}
.ui-navbar-primary .ui-navbar-link-active{background:#2563eb}

.ui-sidebar{width:250px;min-height:100vh;padding:16px 0;border-right:1px solid #e5e7eb;flex-shrink:0;background:#f9fafb;color:#374151}
.ui-sidebar-dark{background:#1f2937;color:#d1d5db;border-right-color:#374151}
.ui-sidebar-header{padding:0 20px 16px;font-weight:700;font-size:1.125rem;border-bottom:1px solid #e5e7eb;margin-bottom:8px}
.ui-sidebar-dark .ui-sidebar-header{border-bottom-color:#374151}
.ui-sidebar-item{display:block;padding:8px 20px;text-decoration:none;color:inherit}
.ui-sidebar-item-active{background:#eff6ff;color:#2563eb;font-weight:600}
.ui-sidebar-dark .ui-sidebar-item-active{background:#374151;color:#fff}
.ui-sidebar-divider{border:none;border-top:1px solid #e5e7eb;margin:8px 0}
.ui-sidebar-dark .ui-sidebar-divider{border-top-color:#374151}
.ui-sidebar-heading{padding:12px 20px 4px;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;color:#6b7280}
.ui-sidebar-dark .ui-sidebar-heading{color:#9ca3af}

.ui-modal-overlay{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center}
.ui-modal-dialog{background:#fff;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,0.3);max-height:90vh;overflow:auto}
.ui-modal-small{max-width:400px;width:100%}.ui-modal-medium{max-width:560px;width:100%}
.ui-modal-large{max-width:800px;width:100%}.ui-modal-fullscreen{max-width:95vw;width:100%}
.ui-modal-header{display:flex;justify-content:space-between;align-items:center;padding:16px 20px;border-bottom:1px solid #e5e7eb}
.ui-modal-header h3{margin:0;font-size:1.125rem}
.ui-modal-close{background:none;border:none;font-size:1.5rem;cursor:pointer;color:#6b7280;padding:0;line-height:1}
.ui-modal-body{padding:20px}
.ui-modal-footer{display:flex;justify-content:flex-end;gap:8px;padding:12px 20px;border-top:1px solid #e5e7eb;background:#f9fafb;border-radius:0 0 12px 12px}

.ui-list-unstyled{list-style:none;padding-left:0}
.ui-list-item{}

.ui-tabs{}
.ui-tabs-nav{display:flex;border-bottom:2px solid #e5e7eb;margin-bottom:16px}
.ui-tab-btn{padding:10px 20px;border:none;background:none;cursor:pointer;font-weight:400;color:#6b7280;border-bottom:2px solid transparent;margin-bottom:-2px;font-size:0.9375rem}
.ui-tab-btn-active{font-weight:600;color:#3b82f6;border-bottom-color:#3b82f6}
.ui-tab-content{}
CSS;
    }
}
