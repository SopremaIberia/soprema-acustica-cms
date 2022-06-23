<?php
/**
 * @file
 * Contains \Drupal\soprema_module\EventSubscriber\RedirectFromFrontpageSubscriber
 */

namespace Drupal\soprema_module\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RedirectFromFrontpageSubscriber implements EventSubscriberInterface {

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        // This announces which events you want to subscribe to.
        // We only need the request event for this example.  Pass
        // this an array of method names
        return([
            KernelEvents::REQUEST => [
                ['redirect_from_frontpage'],
            ]
        ]);
    }

    /**
     * Redirect to Solutions page from FrontPage if user is authenticated.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     */
    public function redirect_from_frontpage(GetResponseEvent $event) {

      if (\Drupal::service('path.matcher')->isFrontPage() && \Drupal::currentUser()->isAuthenticated()) {
        $redirect_url = Url::fromRoute('entity.node.canonical', ['node' => 2]);
        $response = new RedirectResponse($redirect_url->toString(), 301);
        $event->setResponse($response);
      }
    }
}