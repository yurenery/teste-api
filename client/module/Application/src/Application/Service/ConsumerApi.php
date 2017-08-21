<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Service;

use Zend\Http\Request;
use Zend\Http\Client;

class ConsumerApi {

    /**
     * API Address
     * @var string 
     */
    private static $urlApi = "http://localhost:8888/soluti/certificado";

    /**
     * 
     * @param type $data
     * @param type $file
     * @return boolean|string
     */
    public function uploadCertificado($data) {
        return $this->doRequest(Request::METHOD_POST, ['body_param' => $data]);
    }

    /**
     * 
     * @return boolean|string
     */
    public function getCertificados() {
        return $this->doRequest(Request::METHOD_GET);
    }

    /**
     * 
     * @param int $id
     * @return boolean|string
     */
    public function getCertificado($id) {
        return $this->doRequest(Request::METHOD_GET, ['query_param' => [$id]]);
    }

    /**
     * 
     * @param int $id
     * @return boolean
     */
    public function deleteCertificado($id) {
        return $this->doRequest(Request::METHOD_DELETE, ['query_param' => [$id]]);
    }

    /**
     * 
     * @param int $method
     * @param array $data
     * @return array
     */
    private function doRequest($method, Array $data = []) {
        $uri = self::$urlApi;
        if (isset($data['query_param']) && is_array($data['query_param'])) {
            $uri = self::$urlApi . '/' . implode('/', $data['query_param']);
        }

        $client = new Client($uri);
        if (isset($data['body_param']) && is_array($data['body_param'])) {
            $client->setEncType(Client::ENC_FORMDATA);
            $client->setParameterPost($data['body_param']);
        }

        $response = $client->setMethod($method)
                ->setHeaders(['Accept' => 'application/json'])
                ->send();

        if ($response->isSuccess()) {
            return $response->getContent() ?: TRUE;
        }

        return FALSE;
    }

}
