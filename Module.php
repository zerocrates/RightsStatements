<?php
namespace RightsStatements;

use Omeka\Event\Event as OmekaEvent;
use Omeka\Module\AbstractModule;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            ['Omeka\Controller\Admin\Item', 'Omeka\Controller\Admin\ItemSet',
                'Omeka\Controller\Admin\Media'],
            [OmekaEvent::VIEW_ADD_AFTER, OmekaEvent::VIEW_EDIT_AFTER],
            [$this, 'prepareForm']
        );
    }

    public function prepareForm(Event $event)
    {
        $event->getTarget()->headScript()->appendScript('
$(document).on("o:prepare-value", function(e, type, value, valueObj, namePrefix) {
    if (type === "rights_statement") {
        value.find("select")
            .attr("name", namePrefix + "[@id]")
            .val(valueObj ? valueObj["@id"]: null);
    }
});');
    }
}

