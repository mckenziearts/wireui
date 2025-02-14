<?php

namespace WireUi\View\Components;

use Illuminate\Support\{Str, Stringable};

class Checkbox extends FormComponent
{
    public bool $sm;

    public bool $md;

    public bool $lg;

    public ?string $label;

    public ?string $leftLabel;

    public function __construct(
        bool $md = false,
        bool $lg = false,
        ?string $label = null,
        ?string $leftLabel = null
    ) {
        $this->sm        = !$md && !$lg;
        $this->md        = $md;
        $this->lg        = $lg;
        $this->label     = $label;
        $this->leftLabel = $leftLabel;
    }

    protected function getView(): string
    {
        return 'wireui::components.checkbox';
    }

    public function getClasses(bool $hasError): string
    {
        return Str::of("rounded-sm transition ease-in-out duration-100 {$this->getSize()}")->unless(
            $hasError,
            function (Stringable $stringable) {
                return $stringable->append('
                    border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-300
                    dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                    dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                    dark:focus:ring-offset-secondary-800
                ');
            },
            function (Stringable $stringable) {
                return $stringable->append('
                    focus:ring-negative-500 ring-negative-500 border-negative-400 text-negative-600
                    focus:border-negative-400 dark:focus:border-negative-600 dark:ring-negative-600
                    dark:border-negative-600 dark:bg-negative-700 dark:checked:bg-negative-700
                    dark:focus:ring-offset-secondary-800 dark:checked:border-negative-700
                ');
            },
        );
    }

    private function getSize(): string
    {
        return $this->classes(['w-5 h-5' => $this->md, 'w-6 h-6' => $this->lg, ]);
    }
}
