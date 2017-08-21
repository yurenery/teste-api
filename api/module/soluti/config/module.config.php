<?php
return [
    'service_manager' => [
        'factories' => [
            \soluti\V1\Rest\Certificado\CertificadoResource::class => \soluti\V1\Rest\Certificado\CertificadoResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'soluti.rest.certificado' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/soluti/certificado[/:certificado_id]',
                    'defaults' => [
                        'controller' => 'soluti\\V1\\Rest\\Certificado\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'soluti.rest.certificado',
        ],
    ],
    'zf-rest' => [
        'soluti\\V1\\Rest\\Certificado\\Controller' => [
            'listener' => \soluti\V1\Rest\Certificado\CertificadoResource::class,
            'route_name' => 'soluti.rest.certificado',
            'route_identifier_name' => 'certificado_id',
            'collection_name' => 'certificado',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \soluti\V1\Rest\Certificado\CertificadoEntity::class,
            'collection_class' => \soluti\V1\Rest\Certificado\CertificadoCollection::class,
            'service_name' => 'Certificado',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'soluti\\V1\\Rest\\Certificado\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'soluti\\V1\\Rest\\Certificado\\Controller' => [
                0 => 'application/vnd.soluti.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'soluti\\V1\\Rest\\Certificado\\Controller' => [
                0 => 'application/vnd.soluti.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \soluti\V1\Rest\Certificado\CertificadoEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'soluti.rest.certificado',
                'route_identifier_name' => 'certificado_id',
                'hydrator' => \DoctrineModule\Stdlib\Hydrator\DoctrineObject::class,
            ],
            \soluti\V1\Rest\Certificado\CertificadoCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'soluti.rest.certificado',
                'route_identifier_name' => 'certificado_id',
                'is_collection' => true,
            ],
        ],
    ],
    'doctrine' => [
        'driver' => [
            'certificado_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => 'F:\\Projetos\\teste-soluti\\apigility\\module\\soluti\\config/../src/V1/Rest/Certificado',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'soluti\\V1\\Rest\\Certificado' => 'certificado_entities',
                ],
            ],
        ],
    ],
    'zf-content-validation' => [
        'soluti\\V1\\Rest\\Certificado\\Controller' => [
            'input_filter' => 'soluti\\V1\\Rest\\Certificado\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'soluti\\V1\\Rest\\Certificado\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => '1',
                            'max' => '255',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'nome',
                'field_type' => 'text',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => '1',
                            'max' => '65535',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'certificado',
                'field_type' => 'text',
            ],
        ],
    ],
];
