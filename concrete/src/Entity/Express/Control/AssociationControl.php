<?php
namespace Concrete\Core\Entity\Express\Control;

use Concrete\Core\Entity\Express\Entry;
use Concrete\Core\Express\Form\Context\ContextInterface;
use Concrete\Core\Express\Form\Context\FormContext;
use Concrete\Core\Express\Form\Context\ViewContext;
use Concrete\Core\Express\Form\Control\Renderer\AssociationControlFormRenderer;
use Concrete\Core\Express\Form\Control\Renderer\AssociationControlViewRenderer;
use Concrete\Core\Express\Form\Control\Type\SaveHandler\AssociationControlSaveHandler;
use Concrete\Core\Entity\Express\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ExpressFormFieldSetAssociationControls")
 */
class AssociationControl extends Control
{
    /**
     * @var \Concrete\Core\Entity\Express\Association
     * @ORM\ManyToOne(targetEntity="\Concrete\Core\Entity\Express\Association", inversedBy="controls")
     */
    protected $association;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $association_entity_label_mask;

    /**
     * @return mixed
     */
    public function getAssociationEntityLabelMask()
    {
        return $this->association_entity_label_mask;
    }

    /**
     * @param mixed $association_entity_label_mask
     */
    public function setAssociationEntityLabelMask($association_entity_label_mask)
    {
        $this->association_entity_label_mask = $association_entity_label_mask;
    }

    /**
     * @return mixed
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @param mixed $association
     */
    public function setAssociation($association)
    {
        $this->association = $association;
    }

    public function getControlRenderer(ContextInterface $context)
    {
        if ($context instanceof ViewContext) {
            return new AssociationControlViewRenderer();
        }
        if ($context instanceof FormContext) {
            return new AssociationControlFormRenderer();
        }
    }

    public function getControlSaveHandler()
    {
        return new AssociationControlSaveHandler();
    }

    public function getControlLabel()
    {
        return $this->getAssociation()->getTargetEntity()->getName();
    }

    public function getType()
    {
        return 'association';
    }

    public function getExporter()
    {
        return new \Concrete\Core\Export\Item\Express\Control\AssociationControl();
    }



}
