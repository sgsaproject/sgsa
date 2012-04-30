<?php
namespace ApplicationTest\Model\Document;

use Application\Model\Document\Instituicao,
    Application\Model\Document\Campus;

class InstituicaoTest extends \ApplicationTest\Framework\TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testInsertInstituicao()
    {
        $dm = $this->getLocator()->get('mongo_dm');
        $instituicao = new Instituicao();
        $instituicao->setNome('UNIPAMPA');
        $dm->persist($instituicao);
        $dm->flush();
    }

}

