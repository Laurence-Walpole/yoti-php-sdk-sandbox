<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\SandboxBreakdown;
use Yoti\Sandbox\DocScan\Request\SandboxRecommendation;

class SandboxCheckReport implements \JsonSerializable
{

    /**
     * @var SandboxRecommendation
     */
    private $recommendationResponse;

    /**
     * @var SandboxBreakdown[]
     */
    private $breakdownResponse;

    /**
     * SandboxCheck constructor.
     *
     * @param SandboxRecommendation $recommendationResponse
     * @param SandboxBreakdown[] $breakdownResponse
     */
    public function __construct(SandboxRecommendation $recommendationResponse, array $breakdownResponse)
    {
        $this->recommendationResponse = $recommendationResponse;
        $this->breakdownResponse = $breakdownResponse;
    }

    /**
     * @return \stdClass
     */
    public function jsonSerialize(): \stdClass
    {
        return (object) [
            'recommendation' => $this->recommendationResponse,
            'breakdown' => $this->breakdownResponse,
        ];
    }
}