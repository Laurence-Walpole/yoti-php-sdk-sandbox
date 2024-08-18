<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Aml;

use stdClass;
use Yoti\Util\Json;

class SandboxAddress implements \JsonSerializable
{
    private const POSTCODE_ATTR = 'post_code';
    private const COUNTRY_ATTR = 'country';

    /**
     * @var ?string
     */
    private $postcode;

    /**
     * @var \Yoti\Sandbox\Aml\SandboxCountry
     */
    private $country;

    /**
     * AmlAddress constructor.
     *
     * @param \Yoti\Sandbox\Aml\SandboxCountry $country
     * @param null|string $postcode
     */
    public function __construct(SandboxCountry $country, ?string $postcode = null)
    {
        $this->country = $country;
        $this->postcode = $postcode;
    }

    /**
     * @return \Yoti\Sandbox\Aml\SandboxCountry
     */
    public function getCountry(): SandboxCountry
    {
        return $this->country;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * Get address data.
     *
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object) [
            self::POSTCODE_ATTR => $this->getPostcode(),
            self::COUNTRY_ATTR => $this->getCountry(),
        ];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return Json::encode($this);
    }
}
