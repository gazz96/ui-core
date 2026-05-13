<?php

namespace BagasTopati\UiCore\Builders;

use BagasTopati\UiCore\Contracts\Renderable;
use BagasTopati\UiCore\Rendering\Renderer;
use BagasTopati\UiCore\UI;

class TableBuilder implements Renderable
{
    protected array $data = [];
    protected array $columnDefs = [];
    protected array $extraClasses = [];
    protected array $tableAttributes = [];
    protected ?string $emptyMessage = null;
    protected $rowCallback = null;
    protected ?array $actions = null;
    protected ?string $caption = null;
    protected bool $striped = false;
    protected bool $bordered = false;
    protected bool $hoverable = false;
    protected bool $compact = false;
    protected bool $responsive = false;

    protected array $sortableColumns = [];
    protected ?string $sortColumn = null;
    protected string $sortDirection = 'asc';
    protected ?string $sortUrlTemplate = null;

    protected array $filterDefs = [];
    protected array $filterValues = [];
    protected ?string $filterAction = null;
    protected string $searchPlaceholder = 'Cari...';
    protected bool $globalSearch = false;
    protected ?string $globalSearchValue = null;

    protected int $perPage = 15;
    protected int $currentPage = 1;
    protected ?int $totalRecords = null;
    protected bool $paginationEnabled = false;
    protected ?string $paginationUrlTemplate = null;
    protected bool $showPerPageSelector = false;
    protected array $perPageOptions = [10, 15, 25, 50, 100];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function data(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    public function columns(array $columns): static
    {
        foreach ($columns as $key => $label) {
            if (is_int($key)) {
                $this->columnDefs[$label] = ['key' => $label, 'label' => ucfirst($label)];
            } else {
                $this->columnDefs[$key] = ['key' => $key, 'label' => $label];
            }
        }
        return $this;
    }

    public function column(string $key, string $label, ?callable $formatter = null): static
    {
        $this->columnDefs[$key] = [
            'key' => $key,
            'label' => $label,
            'formatter' => $formatter,
        ];
        return $this;
    }

    public function rawColumn(string $name, string $label, callable $callback): static
    {
        $this->columnDefs[$name] = [
            'key' => $name,
            'label' => $label,
            'raw' => true,
            'callback' => $callback,
        ];
        return $this;
    }

    public function class(string|array $class): static
    {
        if (is_string($class)) {
            $class = array_filter(explode(' ', $class));
        }
        $this->extraClasses = array_merge($this->extraClasses, $class);
        return $this;
    }

    public function attr(string $key, string|int|bool|null $value = true): static
    {
        $this->tableAttributes[$key] = $value;
        return $this;
    }

    public function striped(bool $striped = true): static
    {
        $this->striped = $striped;
        return $this;
    }

    public function bordered(bool $bordered = true): static
    {
        $this->bordered = $bordered;
        return $this;
    }

    public function hoverable(bool $hoverable = true): static
    {
        $this->hoverable = $hoverable;
        return $this;
    }

    public function compact(bool $compact = true): static
    {
        $this->compact = $compact;
        return $this;
    }

    public function responsive(bool $responsive = true): static
    {
        $this->responsive = $responsive;
        return $this;
    }

    public function caption(string $caption): static
    {
        $this->caption = $caption;
        return $this;
    }

    public function emptyMessage(string $message): static
    {
        $this->emptyMessage = $message;
        return $this;
    }

    public function actions(array $actions): static
    {
        $this->actions = $actions;
        return $this;
    }

    public function eachRow(callable $callback): static
    {
        $this->rowCallback = $callback;
        return $this;
    }

    public function sortable(string|array $columns = [], ?string $urlTemplate = null): static
    {
        if (is_string($columns)) {
            $columns = [$columns];
        }
        $this->sortableColumns = $columns;
        if ($urlTemplate) {
            $this->sortUrlTemplate = $urlTemplate;
        }
        return $this;
    }

    public function sortBy(string $column, string $direction = 'asc'): static
    {
        $this->sortColumn = $column;
        $this->sortDirection = $direction;
        return $this;
    }

    public function sortUrl(string $template): static
    {
        $this->sortUrlTemplate = $template;
        return $this;
    }

    public function addFilter(string $key, string $type = 'text', array $options = []): static
    {
        $this->filterDefs[$key] = [
            'key' => $key,
            'type' => $type,
            'options' => $options,
            'placeholder' => $options['placeholder'] ?? ucfirst($key),
        ];
        return $this;
    }

    public function filters(array $filters): static
    {
        foreach ($filters as $key => $config) {
            if (is_string($config)) {
                $this->addFilter($key, $config);
            } elseif (is_array($config)) {
                $type = $config['type'] ?? 'text';
                $options = $config;
                unset($options['type']);
                $this->addFilter($key, $type, $options);
            }
        }
        return $this;
    }

    public function filterValues(array $values): static
    {
        $this->filterValues = $values;
        return $this;
    }

    public function filterAction(string $action): static
    {
        $this->filterAction = $action;
        return $this;
    }

    public function searchable(string $placeholder = 'Cari...'): static
    {
        $this->globalSearch = true;
        $this->searchPlaceholder = $placeholder;
        return $this;
    }

    public function searchValue(?string $value): static
    {
        $this->globalSearchValue = $value;
        return $this;
    }

    public function paginate(int $perPage = 15, int $currentPage = 1, ?int $totalRecords = null): static
    {
        $this->paginationEnabled = true;
        $this->perPage = $perPage;
        $this->currentPage = max(1, $currentPage);
        $this->totalRecords = $totalRecords;
        return $this;
    }

    public function paginationUrl(string $template): static
    {
        $this->paginationUrlTemplate = $template;
        return $this;
    }

    public function perPageSelector(array $options = [10, 15, 25, 50, 100]): static
    {
        $this->showPerPageSelector = true;
        $this->perPageOptions = $options;
        return $this;
    }

    protected function resolveColumns(): array
    {
        if (!empty($this->columnDefs)) {
            return $this->columnDefs;
        }

        if (empty($this->data)) {
            return [];
        }

        $firstRow = $this->data[0];
        if (is_array($firstRow)) {
            foreach (array_keys($firstRow) as $key) {
                $this->columnDefs[$key] = ['key' => $key, 'label' => ucfirst($key)];
            }
        } elseif (is_object($firstRow)) {
            $reflection = new \ReflectionClass($firstRow);
            foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
                $key = $prop->getName();
                $this->columnDefs[$key] = ['key' => $key, 'label' => ucfirst($key)];
            }
        }

        return $this->columnDefs;
    }

    protected function getValue(mixed $row, string $key): mixed
    {
        if (is_array($row)) {
            return $row[$key] ?? '';
        }

        if (is_object($row)) {
            $getter = 'get' . ucfirst($key);
            if (method_exists($row, $getter)) {
                return $row->$getter();
            }

            if (property_exists($row, $key)) {
                $ref = new \ReflectionProperty($row, $key);
                if ($ref->isPublic()) {
                    return $row->$key;
                }
            }

            if (method_exists($row, '__get')) {
                return $row->$key;
            }

            return '';
        }

        return '';
    }

    protected function rowToArray(mixed $row): array
    {
        if (is_array($row)) {
            return $row;
        }

        if (is_object($row)) {
            $result = [];
            $reflection = new \ReflectionClass($row);
            foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
                $name = $prop->getName();
                $result[$name] = $prop->getValue($row);
            }
            foreach (get_class_methods($row) as $method) {
                if (str_starts_with($method, 'get') && $method !== 'get') {
                    $key = lcfirst(substr($method, 3));
                    if (!isset($result[$key])) {
                        $result[$key] = $row->$method();
                    }
                }
            }
            return $result;
        }

        return [];
    }

    protected function isSortable(string $key): bool
    {
        if (empty($this->sortableColumns)) {
            return false;
        }
        return in_array($key, $this->sortableColumns) || $this->sortableColumns === ['*'];
    }

    protected function applyClientSort(): array
    {
        if (!$this->sortColumn || empty($this->data)) {
            return $this->data;
        }

        $column = $this->sortColumn;
        $direction = $this->sortDirection;

        usort($this->data, function ($a, $b) use ($column, $direction) {
            $valA = $this->getValue($a, $column);
            $valB = $this->getValue($b, $column);

            if (is_numeric($valA) && is_numeric($valB)) {
                $cmp = $valA <=> $valB;
            } else {
                $cmp = strcasecmp((string)$valA, (string)$valB);
            }

            return $direction === 'desc' ? -$cmp : $cmp;
        });

        return $this->data;
    }

    protected function applyClientFilter(): array
    {
        $data = $this->data;

        if ($this->globalSearch && $this->globalSearchValue !== null && $this->globalSearchValue !== '') {
            $search = strtolower($this->globalSearchValue);
            $data = array_filter($data, function ($row) use ($search) {
                $values = $this->rowToArray($row);
                foreach ($values as $val) {
                    if (str_contains(strtolower((string)$val), $search)) {
                        return true;
                    }
                }
                return false;
            });
            $data = array_values($data);
        }

        foreach ($this->filterValues as $key => $value) {
            if ($value === '' || $value === null) {
                continue;
            }
            $data = array_filter($data, function ($row) use ($key, $value) {
                $rowVal = $this->getValue($row, $key);
                return strtolower((string)$rowVal) === strtolower((string)$value);
            });
            $data = array_values($data);
        }

        return $data;
    }

    protected function getProcessedData(): array
    {
        $data = $this->applyClientFilter();

        $backup = $this->data;
        $this->data = $data;
        $data = $this->applyClientSort();
        $this->data = $backup;

        if ($this->totalRecords === null) {
            $this->totalRecords = count($data);
        }

        if ($this->paginationEnabled) {
            $offset = ($this->currentPage - 1) * $this->perPage;
            $data = array_slice($data, $offset, $this->perPage);
        }

        return $data;
    }

    protected function getTotalPages(): int
    {
        $total = $this->totalRecords ?? count($this->data);
        return max(1, (int)ceil($total / $this->perPage));
    }

    protected function buildSortUrl(string $column): string
    {
        $direction = 'asc';
        if ($this->sortColumn === $column && $this->sortDirection === 'asc') {
            $direction = 'desc';
        }

        if ($this->sortUrlTemplate) {
            return str_replace(
                ['{column}', '{direction}'],
                [$column, $direction],
                $this->sortUrlTemplate
            );
        }

        return "?sort={$column}&direction={$direction}";
    }

    protected function renderSortIcon(string $column): string
    {
        if ($this->sortColumn === $column) {
            return $this->sortDirection === 'asc'
                ? ' <span class="text-body">&#9650;</span>'
                : ' <span class="text-body">&#9660;</span>';
        }
        return ' <span class="text-muted" style="opacity:0.3">&#9650;</span>';
    }

    protected function renderFilterBar(): string
    {
        if (empty($this->filterDefs) && !$this->globalSearch) {
            return '';
        }

        $fw = UI::framework();
        $html = '<div class="mb-3">';

        $action = $this->filterAction ?? '';
        if ($action) {
            $html .= '<form method="GET" action="' . Renderer::escape($action) . '">';
        } else {
            $html .= '<form method="GET">';
        }

        $html .= '<div class="row g-2 align-items-end">';

        if ($this->globalSearch) {
            $html .= '<div class="col-auto" style="min-width:200px">';
            $html .= '<label class="form-label small text-muted">Pencarian</label>';
            $html .= '<input type="text" name="search" class="form-control form-control-sm" placeholder="' . Renderer::escape($this->searchPlaceholder) . '" value="' . Renderer::escape($this->globalSearchValue ?? '') . '">';
            $html .= '</div>';
        }

        foreach ($this->filterDefs as $filter) {
            $html .= '<div class="col-auto" style="min-width:150px">';
            $html .= '<label class="form-label small text-muted">' . Renderer::escape($filter['placeholder']) . '</label>';

            $currentValue = $this->filterValues[$filter['key']] ?? '';

            switch ($filter['type']) {
                case 'select':
                    $html .= '<select name="filter_' . $filter['key'] . '" class="form-select form-select-sm">';
                    $html .= '<option value="">Semua</option>';
                    foreach ($filter['options']['items'] ?? [] as $val => $label) {
                        if (is_int($val)) {
                            $val = $label;
                        }
                        $selected = (string)$currentValue === (string)$val ? ' selected' : '';
                        $html .= '<option value="' . Renderer::escape($val) . '"' . $selected . '>' . Renderer::escape($label) . '</option>';
                    }
                    $html .= '</select>';
                    break;
                case 'date':
                    $html .= '<input type="date" name="filter_' . $filter['key'] . '" class="form-control form-control-sm" value="' . Renderer::escape($currentValue) . '">';
                    break;
                case 'number':
                    $html .= '<input type="number" name="filter_' . $filter['key'] . '" class="form-control form-control-sm" placeholder="' . Renderer::escape($filter['placeholder']) . '" value="' . Renderer::escape($currentValue) . '">';
                    break;
                default:
                    $html .= '<input type="text" name="filter_' . $filter['key'] . '" class="form-control form-control-sm" placeholder="' . Renderer::escape($filter['placeholder']) . '" value="' . Renderer::escape($currentValue) . '">';
                    break;
            }

            $html .= '</div>';
        }

        $html .= '<div class="col-auto">';
        $html .= '<button type="submit" class="btn btn-sm btn-primary">Filter</button> ';
        $html .= '<a href="' . ($this->filterAction ?: '?') . '" class="btn btn-sm btn-secondary">Reset</a>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</form>';
        $html .= '</div>';

        return $html;
    }

    protected function renderInfoBar(): string
    {
        if (!$this->paginationEnabled) {
            return '';
        }

        $total = $this->totalRecords ?? count($this->data);
        $from = $total > 0 ? (($this->currentPage - 1) * $this->perPage) + 1 : 0;
        $to = min($this->currentPage * $this->perPage, $total);

        $html = '<div class="d-flex justify-content-between align-items-center mb-2">';
        $html .= '<div class="text-muted small">Menampilkan ' . $from . '-' . $to . ' dari ' . $total . ' data</div>';

        if ($this->showPerPageSelector) {
            $html .= '<div class="d-flex align-items-center gap-2">';
            $html .= '<label class="text-muted small">Per halaman:</label>';
            $html .= '<select class="form-select form-select-sm" style="width:auto" onchange="window.location.href=this.value">';

            $currentUrl = $this->paginationUrlTemplate
                ? str_replace('{page}', (string)$this->currentPage, $this->paginationUrlTemplate)
                : '?page=' . $this->currentPage;

            foreach ($this->perPageOptions as $opt) {
                $selected = $opt === $this->perPage ? ' selected' : '';
                $url = $this->paginationUrlTemplate
                    ? str_replace(['{page}', '{perPage}'], [(string)$this->currentPage, (string)$opt], $this->paginationUrlTemplate)
                    : '?page=' . $this->currentPage . '&per_page=' . $opt;
                $html .= '<option value="' . Renderer::escape($url) . '"' . $selected . '>' . $opt . '</option>';
            }

            $html .= '</select>';
            $html .= '</div>';
        }

        $html .= '</div>';
        return $html;
    }

    protected function renderPagination(): string
    {
        if (!$this->paginationEnabled) {
            return '';
        }

        $totalPages = $this->getTotalPages();

        if ($totalPages <= 1) {
            return '';
        }

        $pagination = new PaginationBuilder($this->currentPage, $totalPages);
        $pagination->showArrows()->showFirstLast();

        if ($this->paginationUrlTemplate) {
            $pagination->baseUrl($this->paginationUrlTemplate);
        }

        $html = '<div class="d-flex justify-content-center mt-3">';
        $html .= $pagination->render();
        $html .= '</div>';

        return $html;
    }

    public function render(): string
    {
        $fw = UI::framework();
        $columns = $this->resolveColumns();
        $colCount = count($columns) + ($this->actions ? 1 : 0);
        $processedData = $this->getProcessedData();

        $html = '';

        $html .= $this->renderFilterBar();
        $html .= $this->renderInfoBar();

        $tableClasses = array_merge($fw->table(), $this->extraClasses);
        if ($this->striped) {
            $tableClasses = array_merge($tableClasses, $fw->tableStriped());
        }
        if ($this->bordered) {
            $tableClasses = array_merge($tableClasses, $fw->tableBordered());
        }
        if ($this->hoverable) {
            $tableClasses = array_merge($tableClasses, $fw->tableHoverable());
        }
        if ($this->compact) {
            $tableClasses = array_merge($tableClasses, $fw->tableCompact());
        }

        if ($this->responsive) {
            $respClasses = $fw->tableResponsive();
            $html .= "<div" . Renderer::classes($respClasses) . ">";
        }

        $tableAttr = Renderer::buildAttributes($this->tableAttributes, $tableClasses);
        $html .= "<table{$tableAttr}>";

        if ($this->caption) {
            $captionClasses = $fw->tableCaption();
            $html .= "<caption" . Renderer::classes($captionClasses) . ">{$this->caption}</caption>";
        }

        $html .= "<thead><tr>";
        foreach ($columns as $col) {
            $label = $col['label'] ?? ucfirst($col['key']);
            $thClasses = $fw->tableHeaderCell();

            if ($this->isSortable($col['key'])) {
                $sortUrl = $this->buildSortUrl($col['key']);
                $sortIcon = $this->renderSortIcon($col['key']);
                $html .= "<th" . Renderer::classes($thClasses) . ">";
                $html .= '<a href="' . Renderer::escape($sortUrl) . '" class="text-decoration-none text-dark">' . $label . $sortIcon . '</a>';
                $html .= "</th>";
            } else {
                $html .= "<th" . Renderer::classes($thClasses) . ">{$label}</th>";
            }
        }

        if ($this->actions) {
            $thClasses = $fw->tableHeaderCell();
            $html .= "<th" . Renderer::classes($thClasses) . ">Aksi</th>";
        }

        $html .= "</tr></thead>";

        $html .= "<tbody>";

        if (empty($processedData)) {
            $message = $this->emptyMessage ?? 'Tidak ada data';
            $tdClasses = $fw->tableCell();
            $html .= "<tr><td colspan='{$colCount}'" . Renderer::classes(array_merge($tdClasses, ['text-center', 'text-muted', 'py-4'])) . ">{$message}</td></tr>";
        } else {
            foreach ($processedData as $rowIndex => $row) {
                if ($this->rowCallback) {
                    $extra = ($this->rowCallback)($row, $rowIndex);
                    if (is_string($extra)) {
                        $html .= $extra;
                        continue;
                    }
                }

                $trClasses = $fw->tableRow($rowIndex, $this->striped);
                $html .= "<tr" . Renderer::classes($trClasses) . ">";

                foreach ($columns as $col) {
                    $key = $col['key'];
                    $tdClasses = $fw->tableCell();

                    if (!empty($col['raw']) && isset($col['callback']) && is_callable($col['callback'])) {
                        $value = $col['callback']($row);
                    } else {
                        $value = $this->getValue($row, $key);

                        if (isset($col['formatter']) && is_callable($col['formatter'])) {
                            $value = $col['formatter']($value, $row);
                        }
                    }

                    $html .= "<td" . Renderer::classes($tdClasses) . ">{$value}</td>";
                }

                if ($this->actions) {
                    $tdClasses = array_merge($fw->tableCell(), ['ui-table-actions']);
                    $html .= "<td" . Renderer::classes($tdClasses) . ">";
                    foreach ($this->actions as $label => $url) {
                        if (is_callable($url)) {
                            $url = $url($row);
                        }
                        $html .= "<a href='{$url}'>{$label}</a>";
                    }
                    $html .= "</td>";
                }

                $html .= "</tr>";
            }
        }

        $html .= "</tbody></table>";

        if ($this->responsive) {
            $html .= "</div>";
        }

        $html .= $this->renderPagination();

        return $html;
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
