<?php

namespace Codefog\EventsSubscriptions;

class Services
{
    /**
     * Instances
     * @var array
     */
    private static $instances = [];

    /**
     * Get the automator
     *
     * @return Automator
     */
    public static function getAutomator()
    {
        return static::get(
            'automator',
            function () {
                return new Automator(static::getNotificationSender());
            }
        );
    }

    /**
     * Get the event dispatcher
     *
     * @return EventDispatcher
     */
    public static function getEventDispatcher()
    {
        return static::get(
            'event-dispatcher',
            function () {
                return new EventDispatcher();
            }
        );
    }

    /**
     * Get the flash message
     *
     * @return FlashMessage
     */
    public static function getFlashMessage()
    {
        return static::get(
            'flash-message',
            function () {
                return new FlashMessage();
            }
        );
    }

    /**
     * Get the notification sender
     *
     * @return NotificationSender
     */
    public static function getNotificationSender()
    {
        return static::get(
            'notification-sender',
            function () {
                return new NotificationSender();
            }
        );
    }

    /**
     * Get the subscriber
     *
     * @return Subscriber
     */
    public static function getSubscriber()
    {
        return static::get(
            'subscriber',
            function () {
                return new Subscriber(static::getEventDispatcher(), static::getSubscriptionValidator());
            }
        );
    }

    /**
     * Get the subscription validator
     *
     * @return SubscriptionValidator
     */
    public static function getSubscriptionValidator()
    {
        return static::get(
            'subscription-validator',
            function () {
                return new SubscriptionValidator();
            }
        );
    }

    /**
     * Get the instance
     *
     * @param string   $key
     * @param callable $init
     *
     * @return object
     */
    private static function get($key, callable $init)
    {
        if (!isset(static::$instances[$key])) {
            static::$instances[$key] = $init();
        }

        return static::$instances[$key];
    }
}
