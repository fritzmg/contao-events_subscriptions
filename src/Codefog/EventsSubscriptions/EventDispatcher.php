<?php

namespace Codefog\EventsSubscriptions;

use Contao\System;

class EventDispatcher
{
    const EVENT_ON_SUBSCRIBE = 'eventsSubscriptions_onSubscribe';
    const EVENT_ON_UNSUBSCRIBE = 'eventsSubscriptions_onUnsubscribe';

    /**
     * Dispatch the event
     *
     * @param string $name
     * @param object $event
     */
    public function dispatch($name, $event)
    {
        if (!is_array($GLOBALS['TL_HOOKS'][$name])) {
            return;
        }

        foreach ($GLOBALS['TL_HOOKS'][$name] as $callback) {
            if (is_array($callback)) {
                call_user_func([System::importStatic($callback[0]), $callback[1]], $event);
            }
        }
    }
}
