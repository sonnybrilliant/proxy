<?php

namespace MlankaTech\AppBundle\Services\Proxy;

use JMS\DiExtraBundle\Annotation as DI;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;

/**
 * ProxyManager.
 *
 * @DI\Service("proxy.manager")
 *
 * @author  Mfana Ronald Conco <ronald.conco@mlankatech.co.za>
 *
 * @version 0.0.1
 */
class ProxyManager
{
    /**
     * @var Monolog logger
     */
    protected $logger;

    /**
     * Producer voucher create
     * @var Service
     * @Inject("old_sound_rabbit_mq.proxy_pass_producer", required = true)
     */
    public $proxyPassProducer;

    /**
     * @param Logger  $logger
     *
     * @DI\InjectParams({
     *     "logger"  = @DI\Inject("logger")
     * })
     */
    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param $payload
     */
    public function publish($payload)
    {
        $this->proxyPassProducer->publish($payload,$routing = 'proxy.pass');
    }

}
