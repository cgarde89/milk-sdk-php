<?php

namespace HiFolks\Milk\Utils;

class GeoJson
{
    /**
     * @var array<mixed>
     */
    private $featureCollection = [];


    /**
     * @param float $latitude
     * @param float $longitude
     * @param array<mixed> $properties
     * @param mixed $id
     * @return void
     */
    public function addPoint(float $latitude, float $longitude, $properties = null, $id = null): void
    {
        $point = new \GeoJson\Geometry\Point([ $longitude , $latitude]);
        $f = new \GeoJson\Feature\Feature($point, $properties, $id);
        $this->featureCollection[] = $f;
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        $fs = new \GeoJson\Feature\FeatureCollection($this->featureCollection);
        return json_encode($fs);
    }

    /**
     * @param int $idx
     * @param bool $jsonEncoded
     * @return string|mixed
     */
    public function get($idx = 0, $jsonEncoded = true)
    {
        $item = $this->featureCollection[$idx];
        if ($jsonEncoded) {
            return json_encode($item);
        }
        return $item;
    }
}
