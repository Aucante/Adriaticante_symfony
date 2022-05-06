<?php

namespace App\Twig;

use App\Repository\PropertyRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LatestPropertiesExtension extends AbstractExtension
{
    private PropertyRepository $propertyRepository;

    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('latest_properties', [$this, 'getLatestProperties']),
        ];
    }

    public function getLatestProperties(): array
    {
        return $this->propertyRepository->lastFive();
    }
}
