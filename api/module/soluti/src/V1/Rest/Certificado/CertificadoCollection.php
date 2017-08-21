<?php

namespace soluti\V1\Rest\Certificado;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class CertificadoCollection extends Paginator {
    
    /**
     * Construtor
     * @param type $certificadoCollection
     */
    public function __construct($certificadoCollection) {
        parent::__construct(new ArrayAdapter($certificadoCollection));
    }    
}
