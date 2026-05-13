<?php

namespace BagasTopati\UiCore;

use BagasTopati\UiCore\CssFrameworks\BootstrapFramework;
use BagasTopati\UiCore\CssFrameworks\DefaultFramework;
use BagasTopati\UiCore\CssFrameworks\TailwindFramework;
use BagasTopati\UiCore\Contracts\CssFramework;
use BagasTopati\UiCore\Builders\AlertBuilder;
use BagasTopati\UiCore\Builders\CardBuilder;
use BagasTopati\UiCore\Builders\ContainerBuilder;
use BagasTopati\UiCore\Builders\ElementBuilder;
use BagasTopati\UiCore\Builders\FlexBuilder;
use BagasTopati\UiCore\Builders\FormBuilder;
use BagasTopati\UiCore\Builders\GridBuilder;
use BagasTopati\UiCore\Builders\ListBuilder;
use BagasTopati\UiCore\Builders\ModalBuilder;
use BagasTopati\UiCore\Builders\NavbarBuilder;
use BagasTopati\UiCore\Builders\PageBuilder;
use BagasTopati\UiCore\Builders\SidebarBuilder;
use BagasTopati\UiCore\Builders\TableBuilder;
use BagasTopati\UiCore\Builders\TabsBuilder;
use BagasTopati\UiCore\Builders\UtilityBuilder;
use BagasTopati\UiCore\Builders\AccordionBuilder;
use BagasTopati\UiCore\Builders\BadgeBuilder;
use BagasTopati\UiCore\Builders\BreadcrumbBuilder;
use BagasTopati\UiCore\Builders\ButtonGroupBuilder;
use BagasTopati\UiCore\Builders\CarouselBuilder;
use BagasTopati\UiCore\Builders\CollapseBuilder;
use BagasTopati\UiCore\Builders\DropdownBuilder;
use BagasTopati\UiCore\Builders\OffcanvasBuilder;
use BagasTopati\UiCore\Builders\PaginationBuilder;
use BagasTopati\UiCore\Builders\ProgressBuilder;
use BagasTopati\UiCore\Builders\SpinnerBuilder;
use BagasTopati\UiCore\Builders\ToastBuilder;
use BagasTopati\UiCore\Builders\TooltipBuilder;

class UI
{
    protected static ?CssFramework $framework = null;
    protected static array $registry = [];

    public static function framework(): CssFramework
    {
        if (static::$framework === null) {
            static::$framework = new DefaultFramework();
        }
        return static::$framework;
    }

    public static function setFramework(CssFramework $framework): void
    {
        static::$framework = $framework;
    }

    public static function useDefault(): void
    {
        static::$framework = new DefaultFramework();
    }

    public static function useTailwind(): void
    {
        static::$framework = new TailwindFramework();
    }

    public static function useBootstrap(): void
    {
        static::$framework = new BootstrapFramework();
    }

    public static function form(string $action = '#'): FormBuilder
    {
        return new FormBuilder($action);
    }

    public static function table(array $data = []): TableBuilder
    {
        return new TableBuilder($data);
    }

    public static function page(string $title, array $body = []): PageBuilder
    {
        return new PageBuilder($title, $body);
    }

    public static function card(string $title, string|int|null $value = null): CardBuilder
    {
        return new CardBuilder($title, $value);
    }

    public static function grid(array $items = [], int $columns = 2): GridBuilder
    {
        return (new GridBuilder($items))->columns($columns);
    }

    public static function navbar(string $brand): NavbarBuilder
    {
        return new NavbarBuilder($brand);
    }

    public static function sidebar(): SidebarBuilder
    {
        return new SidebarBuilder();
    }

    public static function container(array $children = []): ContainerBuilder
    {
        return new ContainerBuilder($children);
    }

    public static function flex(array $children = []): FlexBuilder
    {
        return new FlexBuilder($children);
    }

    public static function alert(string $message, string $variant = 'info'): AlertBuilder
    {
        return new AlertBuilder($message, $variant);
    }

    public static function modal(string $id, string $title): ModalBuilder
    {
        return new ModalBuilder($id, $title);
    }

    public static function list(array $items = []): ListBuilder
    {
        return ListBuilder::ul($items);
    }

    public static function ul(array $items = []): ListBuilder
    {
        return ListBuilder::ul($items);
    }

    public static function ol(array $items = []): ListBuilder
    {
        return ListBuilder::ol($items);
    }

    public static function tabs(): TabsBuilder
    {
        return new TabsBuilder();
    }

    public static function element(string $tag, ?string $content = null): ElementBuilder
    {
        return new ElementBuilder($tag, $content);
    }

    public static function div(?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('div', $content);
    }

    public static function span(?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('span', $content);
    }

    public static function h1(?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('h1', $content);
    }

    public static function h2(?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('h2', $content);
    }

    public static function h3(?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('h3', $content);
    }

    public static function p(?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('p', $content);
    }

    public static function a(string $href, ?string $content = null): ElementBuilder
    {
        return ElementBuilder::make('a', $content)->attr('href', $href);
    }

    public static function img(string $src, ?string $alt = null): ElementBuilder
    {
        return ElementBuilder::make('img')->attr('src', $src)->attr('alt', $alt ?? '');
    }

    public static function button(string $content, string $type = 'button'): ElementBuilder
    {
        return ElementBuilder::make('button', $content)->attr('type', $type);
    }

    public static function hr(): ElementBuilder
    {
        return ElementBuilder::make('hr');
    }

    public static function br(): ElementBuilder
    {
        return ElementBuilder::make('br');
    }

    public static function utility(array $classes = []): UtilityBuilder
    {
        return new UtilityBuilder($classes);
    }

    public static function accordion(string $id = 'accordion'): AccordionBuilder
    {
        return new AccordionBuilder($id);
    }

    public static function badge(string $text): BadgeBuilder
    {
        return new BadgeBuilder($text);
    }

    public static function breadcrumb(): BreadcrumbBuilder
    {
        return new BreadcrumbBuilder();
    }

    public static function buttonGroup(array $buttons = []): ButtonGroupBuilder
    {
        return (new ButtonGroupBuilder())->buttons($buttons);
    }

    public static function carousel(string $id = 'carousel'): CarouselBuilder
    {
        return new CarouselBuilder($id);
    }

    public static function collapse(string $id): CollapseBuilder
    {
        return new CollapseBuilder($id);
    }

    public static function dropdown(string $label, string $id = ''): DropdownBuilder
    {
        return new DropdownBuilder($label, $id);
    }

    public static function offcanvas(string $id, string $title = ''): OffcanvasBuilder
    {
        return new OffcanvasBuilder($id, $title);
    }

    public static function pagination(int $currentPage = 1, int $totalPages = 1): PaginationBuilder
    {
        return new PaginationBuilder($currentPage, $totalPages);
    }

    public static function progress(): ProgressBuilder
    {
        return new ProgressBuilder();
    }

    public static function spinner(): SpinnerBuilder
    {
        return new SpinnerBuilder();
    }

    public static function toast(string $id = ''): ToastBuilder
    {
        return new ToastBuilder($id);
    }

    public static function tooltip(string $content): TooltipBuilder
    {
        return new TooltipBuilder($content);
    }

    public static function register(string $name, callable $factory): void
    {
        static::$registry[$name] = $factory;
    }

    public static function registered(string $name): bool
    {
        return isset(static::$registry[$name]);
    }

    public static function create(string $name, ...$args): mixed
    {
        if (!isset(static::$registry[$name])) {
            throw new \InvalidArgumentException("Component '{$name}' is not registered. Use UI::register() first.");
        }
        return (static::$registry[$name])(...$args);
    }

    public static function getRegistered(): array
    {
        return array_keys(static::$registry);
    }
}
