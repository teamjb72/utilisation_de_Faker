<?php
//AppBundle/Admin/ArbeAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArbeAdmin extends AbstractAdmin{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('denomination', 'text');
        $formMapper->add('poids');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('denomination');
        $datagridMapper->add('poids');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('denomination');
        $listMapper->addIdentifier('poids');

    }

}