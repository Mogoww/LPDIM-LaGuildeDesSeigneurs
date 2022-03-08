<?php

namespace App\Listener;

use App\Event\PlayerEvent;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PlayerListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return array(PlayerEvent::PLAYER_MODIFY => 'playerModify',);
    }

    public function playerModify($event)
    {
        $player = $event->getPlayer();
        $mirian = $player->getMirian();
        $player->setMirian($mirian-10);

    }
}
