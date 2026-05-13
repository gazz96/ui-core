<?php

namespace BagasTopati\UiCore\Contracts;

interface CssFramework
{
    public function name(): string;

    public function grid(int $columns, string $gap): array;

    public function flexRow(string $gap): array;

    public function flexCol(string $gap): array;

    public function flexCenter(): array;

    public function flexBetween(): array;

    public function flexWrap(): array;

    public function container(bool $fluid, ?string $maxWidth): array;

    public function card(?string $variant): array;

    public function cardHeader(): array;

    public function cardBody(): array;

    public function cardFooter(): array;

    public function cardImage(): array;

    public function alert(string $variant): array;

    public function alertTitle(): array;

    public function alertBody(): array;

    public function alertDismiss(): array;

    public function table(): array;

    public function tableStriped(): array;

    public function tableBordered(): array;

    public function tableHoverable(): array;

    public function tableCompact(): array;

    public function tableResponsive(): array;

    public function tableHeader(): array;

    public function tableHeaderCell(): array;

    public function tableBody(): array;

    public function tableRow(int $rowIndex, bool $striped): array;

    public function tableCell(): array;

    public function tableCaption(): array;

    public function formGroup(): array;

    public function formLabel(): array;

    public function formInput(): array;

    public function formSelect(): array;

    public function formTextarea(): array;

    public function formCheckbox(): array;

    public function formRadio(): array;

    public function formRow(): array;

    public function formRowItem(): array;

    public function buttonPrimary(): array;

    public function buttonSecondary(): array;

    public function button(?string $variant): array;

    public function navbar(?string $variant): array;

    public function navbarBrand(): array;

    public function navbarLinks(): array;

    public function navbarLink(bool $active): array;

    public function sidebar(string $variant): array;

    public function sidebarHeader(): array;

    public function sidebarItem(bool $active): array;

    public function sidebarDivider(): array;

    public function sidebarHeading(): array;

    public function modalOverlay(): array;

    public function modalDialog(string $size, bool $centered): array;

    public function modalContent(): array;

    public function modalHeader(): array;

    public function modalBody(): array;

    public function modalFooter(): array;

    public function modalClose(): array;

    public function modalShowScript(string $id): string;

    public function modalHideScript(string $id): string;

    public function list(string $type, bool $styled): array;

    public function listItem(): array;

    public function tabsContainer(): array;

    public function tabsNav(): array;

    public function tabButton(bool $active): array;

    public function tabContent(): array;

    public function pageBody(): array;

    public function pageTitle(): array;

    public function generateStylesheet(): string;

    public function requiresExternalCss(): bool;

    public function externalCssUrls(): array;

    public function externalJsUrls(): array;

    public function resolveUtility(string $category, array $params): ?string;

    public function accordion(): array;

    public function accordionItem(bool $open): array;

    public function accordionHeader(): array;

    public function accordionButton(bool $collapsed): array;

    public function accordionCollapse(): array;

    public function accordionBody(): array;

    public function breadcrumb(): array;

    public function breadcrumbItem(bool $active): array;

    public function badge(?string $variant, bool $pill): array;

    public function buttonGroup(?string $size): array;

    public function buttonToolbar(): array;

    public function carousel(): array;

    public function carouselInner(): array;

    public function carouselItem(bool $active): array;

    public function carouselIndicator(bool $active): array;

    public function carouselControl(string $direction): array;

    public function collapse(): array;

    public function dropdown(): array;

    public function dropdownMenu(): array;

    public function dropdownItem(bool $active, bool $disabled): array;

    public function dropdownDivider(): array;

    public function dropdownHeader(): array;

    public function offcanvas(string $placement): array;

    public function offcanvasHeader(): array;

    public function offcanvasBody(): array;

    public function offcanvasShowScript(string $id): string;

    public function offcanvasHideScript(string $id): string;

    public function pagination(): array;

    public function paginationItem(bool $active, bool $disabled): array;

    public function paginationLink(bool $active, bool $disabled): array;

    public function placeholder(): array;

    public function placeholderCol(int $size): array;

    public function popover(): array;

    public function progress(): array;

    public function progressBar(?string $variant, bool $striped, bool $animated): array;

    public function spinner(?string $variant, string $type): array;

    public function toast(): array;

    public function toastHeader(): array;

    public function toastBody(): array;

    public function tooltip(): array;
}
