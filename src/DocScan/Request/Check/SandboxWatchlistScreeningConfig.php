<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use stdClass;

/**
 * Class SandboxWatchlistScreeningConfig
 * @package Yoti\Sandbox\DocScan\Request\Check
 */
class SandboxWatchlistScreeningConfig implements SandboxCheckConfigInterface
{
    /**
     * @var string[]
     */
    private $categories;

    /**
     * RequestedWatchlistScreeningConfig constructor.
     * @param string[] $categories
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object) [
            'categories' => $this->categories,
        ];
    }

    /**
     * @return string[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }
}
