<?php


namespace App\Form\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ContractFormEventSubscriber implements EventSubscriberInterface
{

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return array(FormEvents::PRE_SUBMIT => 'preSubmitData');

    }

    public function preSubmitData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $days = $data->getDays();

    }
}