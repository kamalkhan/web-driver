<?php

/*
 * This file is part of bhittani/web-driver.
 *
 * (c) Kamal Khan <shout@bhittani.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Bhittani\WebDriver\Payload;

class Payload implements Contract
{
    /**
     * Width of the browser.
     *
     * @var int
     */
    protected $width = 1440;

    /**
     * Height of the browser.
     *
     * @var int
     */
    protected $height = 900;

    /**
     * Use the browser GPU or not.
     *
     * @var bool
     */
    protected $gpu = true;

    /**
     * Use a headless browser or not.
     *
     * @var bool
     */
    protected $headless = true;

    /**
     * Make the payload.
     *
     * @return Payload
     */
    public static function make(array $options)
    {
        $payload = new static;

        foreach ($options as $key => $value) {
            if (method_exists($payload, $key)) {
                $payload->{$key}($value);
            }
        }

        return $payload;
    }

    /** {@inheritdoc} */
    public function isHeadless()
    {
        return (bool) $this->headless;
    }

    /** {@inheritdoc} */
    public function useGpu()
    {
        return (bool) $this->gpu;
    }

    /** {@inheritdoc} */
    public function getWidth()
    {
        return $this->width;
    }

    /** {@inheritdoc} */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Whether to use to browser GPU or not.
     *
     * @param bool $bool
     *
     * @return Payload
     */
    public function gpu($bool = true)
    {
        $this->gpu = (bool) $bool;

        return $this;
    }

    /**
     * Whether to use a headless browser or not.
     *
     * @param bool $bool
     *
     * @return Payload
     */
    public function headless($bool = true)
    {
        $this->headless = (bool) $bool;

        return $this;
    }

    /**
     * Set the width of the browser.
     *
     * @param int $width
     *
     * @return Payload
     */
    public function width($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Set the height of the browser.
     *
     * @param int $height
     *
     * @return Payload
     */
    public function height($height)
    {
        $this->height = $height;

        return $this;
    }
}
