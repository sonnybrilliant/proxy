<?php

namespace MlankaTech\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProxyController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function proxyAction(Request $request)
    {
        $logger = $this->get('logger');
        $logger->error("ProxyController proxyAction");
        if($request->isMethod('POST')){
            $logger->error("ProxyController proxyAction POST");
            $data = explode(',',urldecode($request->get('val')));

            $payload = new \stdClass();
            if($data[0] != ''){
                $payload->coachName = $data[0];
                $payload->lineVoltage = $data[1];
                $payload->gpsTime = $data[2];
                $payload->gpsSpeed = $data[3];
                $payload->lat = $data[4];
                $payload->long = $data[5];
                $payload->boggieCurrent1 = $data[6];
                $payload->boggieCurrent2 = $data[7];
                $payload->breakValve = $data[8];
                $payload->Supply100 = $data[9];
                $payload->speedo = $data[10];
                $payload->shaftEncode1 = $data[11];
                $payload->shaftEncode2 = $data[12];
                $payload->shaftEncode3 = $data[13];
                $payload->shaftEncode4 = $data[14];

                //send data
                $logger->error("ProxyController proxyAction Send payload");
                $this->get('proxy.manager')->publish($payload);
                $logger->error("ProxyController proxyAction Send sent");
            }
        }
        return $this->render('MlankaTechAppBundle:Proxy:proxy.html.twig', array());
    }
}
