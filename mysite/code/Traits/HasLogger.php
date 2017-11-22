<?php

namespace MitsubishiMotors\Traits;

use Psr\Log\LoggerInterface;

/**
 * Trait HasLoggerTrait
 * @package MitsubishiMotors\Traits
 */
trait HasLogger
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
