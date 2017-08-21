<?php

namespace soluti\V1\Rest\Certificado;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="certificados")
 */
class CertificadoEntity {

    protected static $fillable = ['id'];

    public function __construct(Array $data = NULL) {
        if (!empty($data)) {
            foreach ($this as $attr => $value) {
                if (isset($data[$attr]) && !in_array($attr, self::$fillable)) {
                    $this->$attr = $data[$attr];
                }
            }
        }
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @var string
     */
    private $certificado;

    /**
     * 
     * @return string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * 
     * @param string $nome
     * @return \soluti\V1\Entities\Certificado
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCertificado() {
        return $this->certificado;
    }

    /**
     * 
     * @param string $certificado
     * @return \soluti\V1\Entities\Certificado
     */
    public function setCertificado($certificado) {
        $this->certificado = $certificado;
        return $this;
    }

}
