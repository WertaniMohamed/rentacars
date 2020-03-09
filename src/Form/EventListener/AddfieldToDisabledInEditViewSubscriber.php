<?php


namespace App\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddfieldToDisabledInEditViewSubscriber implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {

        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.

        return array(FormEvents::PRE_SET_DATA => 'preSetData');

    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        // check if the object is "new"
        // If you didn't pass any data to the form, the data is "null".
        // This should be considered a new object
        if (!$data || !$data->getId()) {
            $form->add('name');
        } else {
            $form->add('name', null, array('disabled' => true));
            //If PHP >= 5.4
            //$form->add('fieldToDisabledInEditView', null, ['disabled' => true]);
        }
    }
}