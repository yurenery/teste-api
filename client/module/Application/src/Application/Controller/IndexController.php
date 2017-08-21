<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\ConsumerApi;
use phpseclib\File\X509;
use Application\Form\CertificadoForm;

class IndexController extends AbstractActionController {

    private $consumerApi;

    public function __construct() {
        $this->consumerApi = new ConsumerApi();
    }

    public function indexAction() {
        $message = '';
        $header = '';
        $certificados = $this->consumerApi->getCertificados();

        if ($certificados) {
            $certificados = json_decode($certificados);
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao consultar Certificados.");
        }

        return new ViewModel(compact('message', 'header', 'certificados'));
    }

    public function createAction() {
        $form = new CertificadoForm('upload-form');

        if ($this->getRequest()->isPost()) {
            $post = array_merge_recursive(
                    $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                $data['certificado'] = file_get_contents($data['certificado']['tmp_name']);

                if ($this->consumerApi->uploadCertificado($data)) {
                    $this->flashMessenger()->addInfoMessage("Certificado cadastrado com sucesso.");
                    return $this->redirect()->toUrl('/');
                } else {
                    $this->flashMessenger()->addErrorMessage("Erro ao cadastrar Certificado. Tente novamente.");
                }
            }
        }

        return new ViewModel(compact('form'));
    }

    public function viewAction() {
        $message = '';
        $header = '';

        $certificado = $this->consumerApi->getCertificado($this->params('id'));

        if ($certificado) {
            $certificado = json_decode($certificado);
            $parseFile = new X509();
            $detalhes = $parseFile->loadX509($certificado->certificado);
            $certificado->notBefore = date('d/m/Y', strtotime($detalhes['tbsCertificate']['validity']['notBefore']['utcTime']));
            $certificado->notAfter = date('d/m/Y', strtotime($detalhes['tbsCertificate']['validity']['notAfter']['utcTime']));
            $certificado->subjectDn = $parseFile->getSubjectDN(X509::DN_STRING);
            $certificado->issuerDn = $parseFile->getIssuerDN(X509::DN_STRING);
        } else {
            $this->flashMessenger()->addErrorMessage("Erro ao consultar Certificado {$this->params('id')}.");
            return $this->redirect()->toUrl('/');
        }

        return new ViewModel(compact('message', 'header', 'certificado'));
    }

    public function deleteAction() {
        $certificado = $this->consumerApi->deleteCertificado($this->params('id'));

        if ($certificado) {
            $this->flashMessenger()->addInfoMessage("O Certificado {$this->params('id')} foi excluído com sucesso.");
        } else {
            $this->flashMessenger()->addErrorMessage("O Certificado {$this->params('id')} não pôde ser excluído.");
        }
        return $this->redirect()->toUrl('/');
    }

}
