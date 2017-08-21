<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter;
use Zend\Form\Element;

class CertificadoForm extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements() {
        $nome = new Element\Text('nome');
        $nome->setAttribute('class', 'form-control')
                ->setLabel('Nome')
                ->setAttribute('id', 'certificado');
        $this->add($nome);

        $certificado = new Element\File('certificado');
        $certificado->setAttribute('class', 'form-control')
                ->setLabel('Certificado')
                ->setAttribute('id', 'certificado');
        $this->add($certificado);
    }

    public function addInputFilter() {
        $inputFilter = new InputFilter\InputFilter();

        $nomeInput = new InputFilter\Input('nome');
        $nomeInput->setRequired(true);

        $certificadoInput = new InputFilter\FileInput('certificado');
        $certificadoInput->setRequired(true);

        $inputFilter->add($certificadoInput)->add($nomeInput);

        $this->setInputFilter($inputFilter);
    }

}
