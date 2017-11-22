<?php

namespace MitsubishiMotors\Extensions;

use \SilverStripe\Core\Extension;

/**
 * Add a decorator that will return the ratio of a requested image
 * Might not be the best place for that?
 *
 *
 * Class ImageExtension
 * @package MitsubishiMotors\Extensions
 */
class ImageExtension extends Extension
{
    /**
     * @param $width
     * @return mixed
     */
    public function Square($width)
    {
        $variant = $this->owner->variantName(__FUNCTION__, $width);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($width) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            $resource->fit($width);
            $clone->setImageResource($resource);
            return $clone;
        });
    }

    /**
     * @param null $amount
     * @return mixed
     */
    public function Blur($amount = null)
    {
        $variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            $resource->blur($amount);
            $clone->setImageResource($resource);
            return $clone;
        });
    }

    /**
     * @return null|string
     */
    public function GetRatio()
    {
        if (!$this->owner->getIsImage() || !$this->owner->exists()) {
            return null;
        }

        $width = $this->owner->getWidth();
        $height = $this->owner->getHeight();
        $ratio = $height / $width;
        $formatRatio = number_format($ratio * 100, 2);
        return $formatRatio;
    }
}
