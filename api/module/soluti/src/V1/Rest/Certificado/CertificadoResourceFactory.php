<?php
namespace soluti\V1\Rest\Certificado;

class CertificadoResourceFactory
{
    public function __invoke($services)
    {
        return new CertificadoResource($services->get(\Doctrine\ORM\EntityManager::class));
    }
}
