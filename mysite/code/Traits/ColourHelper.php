<?php

namespace MitsubishiMotors\Traits;

/**
 * Trait ColourHelper
 * @package MitsubishiMotors\Traits
 */
trait ColourHelper
{
    /**
     * @var array
     */
    public static $palette = [
        'light' => '#ffffff',
        'dark' => '#000000',
    ];

    /**
     * @param $colour
     * @return mixed
     */
    public function getBestContrastLabel($colour)
    {
        return (hexdec($colour) > 0xffffff / 2) ? 'dark' : 'light';
    }

    /**
     * @param $colour
     * @return mixed
     */
    public function getBestContrast($colour)
    {
        $label = $this->getBestContrastLabel($colour);
        return ColourHelper::$palette[$label];
    }

    /**
     * Method to return The best contrast for the given colour using luminosity contrast ratio algorithm
     *
     * @param $colour
     * @return mixed
     */
    public function getBestLuminosityContrast($colour)
    {
        $label = $this->getBestLuminosityContrastLabel($colour);
        return ColourHelper::$palette[$label];
    }

    /**
     * Method to return The best contrast for the given colour using luminosity contrast ratio algorithm
     *
     * @param $colour
     * @return mixed
     */
    public function getBestLuminosityContrastLabel($colour)
    {
        // convert hexa colour to RGB
        $R1 = hexdec(substr($colour, 0, 2));
        $G1 = hexdec(substr($colour, 2, 2));
        $B1 = hexdec(substr($colour, 4, 2));

        // black RGB
        $blackColor = "#000000";
        $R2BlackColor = hexdec(substr($blackColor, 0, 2));
        $G2BlackColor = hexdec(substr($blackColor, 2, 2));
        $B2BlackColor = hexdec(substr($blackColor, 4, 2));

        // calc contrast ratio
        $L1 = 0.2126 * pow($R1 / 255, 2.2) +
            0.7152 * pow($G1 / 255, 2.2) +
            0.0722 * pow($B1 / 255, 2.2);

        $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
            0.7152 * pow($G2BlackColor / 255, 2.2) +
            0.0722 * pow($B2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
        }

        // if contrast is more than 5, return dark palette colour
        // if not, return light palette colour.
        if ($contrastRatio > 5) {
            return 'dark';
        } else {
            return 'light';
        }
    }
}
