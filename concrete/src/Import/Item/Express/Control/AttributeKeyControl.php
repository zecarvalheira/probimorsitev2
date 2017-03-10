<?php
namespace Concrete\Core\Import\Item\Express\Control;

use Concrete\Core\Application\Application;
use Concrete\Core\Attribute\Category\ExpressCategory;
use Concrete\Core\Entity\Express\Entity;
use Concrete\Core\Import\Item\Express\ItemInterface;
use Doctrine\ORM\EntityManager;

defined('C5_EXECUTE') or die("Access Denied.");

class AttributeKeyControl implements ItemInterface
{

    protected $entityManager;
    protected $application;

    public function __construct(Application $application, EntityManager $entityManager)
    {
        $this->application = $application;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $control \Concrete\Core\Entity\Express\Control\AttributeKeyControl
     * @param \SimpleXMLElement $xml
     */
    public function import(\SimpleXMLElement $xml, Entity $entity)
    {
        $control = new \Concrete\Core\Entity\Express\Control\AttributeKeyControl();
        $control->setCustomLabel((string)$xml['custom-label']);
        if (((string)$xml['required']) == '1') {
            $control->setIsRequired(true);
        }
        $control->setId((string)$xml['id']);
        $category = new ExpressCategory($entity, $this->application, $this->entityManager);

        if (isset($xml->attributekey)) {
            $ak = $xml->attributekey;
            $type = $this->application->make('Concrete\Core\Attribute\TypeFactory')->getByHandle((string)$ak['type']);
            $key = $category->import($type, $ak);
            $control->setAttributeKey($key);
        }

        return $control;
    }

}
