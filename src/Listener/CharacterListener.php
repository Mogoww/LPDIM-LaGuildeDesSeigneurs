<?php

namespace App\Listener;

use App\Event\CharacterEvent;
use DateTime;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CharacterListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return array(CharacterEvent::CHARACTER_CREATED => 'characterCreated',);
    }

    public function characterCreated($event)
    {
        $character = $event->getCharacter();
        $character->setIntelligence(250);

        $startDate = new DateTime("2022-03-07");
        $endDate = new DateTime("2022-03-10");
        $dateNow = new DateTime();
        if ($dateNow <= $endDate && $dateNow >= $startDate)
            $character->setLife(20);
    }
}
