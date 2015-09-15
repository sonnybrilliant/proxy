<?php

namespace MlankaTech\AppBundle\Services\Proxy;

use JMS\DiExtraBundle\Annotation as DI;
use JMS\DiExtraBundle\Annotation\Inject;

/**
 * ProxyManager.
 *
 * @DI\Service("proxy.manager")
 *
 * @author  Mfana Ronald Conco <ronald.conco@mlankatech.co.za>
 *
 * @version 0.0.1
 */
class AgentManager
{

    /**
     * Producer voucher create
     * @var Service
     * @Inject("old_sound_rabbit_mq.proxy_pass_producer", required = true)
     */
    public $proxyPassProducer;

    public function __construct(){}

    /**
     * @param $payload
     */
    public function publish($payload)
    {
        $this->proxyPassProducer->publish(json_encode($payload),$routing = 'proxy.pass');
    }

}
