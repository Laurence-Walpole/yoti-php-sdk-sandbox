<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Advanced;

use stdClass;
use Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced\SandboxCaSources;
use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxSearchProfileSources extends SandboxCaSources
{
    /**
     * @var string
     */
    private $searchProfile;

    /**
     * @param string $searchProfile
     */
    public function __construct(string $searchProfile)
    {
        $this->searchProfile = $searchProfile;
    }

    /**
     * @return string
     */
    public function getSearchProfile(): string
    {
        return $this->searchProfile;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return SandboxConstants::PROFILE;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        $json = parent::jsonSerialize();
        $json->search_profile = $this->getSearchProfile();

        return $json;
    }
}
