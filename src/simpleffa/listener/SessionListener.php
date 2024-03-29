<?php
/* 
 * Copyright (C) Sergittos - All Rights Reserved 
 * Unauthorized copying of this file, via any medium is strictly prohibited 
 * Proprietary and confidential 
 */

declare(strict_types=1);


namespace simpleffa\listener;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\block\Fire;
use pocketmine\block\Lava;
use pocketmine\player\Player;
use simpleffa\session\SessionFactory;

class SessionListener implements Listener {

    public function onLogin(PlayerLoginEvent $event): void {
        SessionFactory::createSession($event->getPlayer());
    }

public function onDeath(PlayerDeathEvent $event)
    {
        // Here the code to kill streak
    }

// Here the code to cancel the hunger
public function onExhaust(PlayerExhaustEvent $event) 
   {
$event->cancel();
   }

// Here the code to cancel breaking blocks
public function onBreak(BlockBreakEvent $event): void
   {
        $player = $event->getPlayer();
        
        if ($player->hasPermission('blockbreak.permission'))
            return;
        
        $event->cancel();
   }

// Here the code to cancel the puts blocks

public function onPlace(BlockPlaceEvent $event) 
   {
        $player = $event->getPlayer();

        if ($player->hasPermission('blockplace.permission'))
            return;

        $event->cancel();
   }

// Here the code to cancel item dropping
public function onDrop(PlayerDropItemEvent $event) 
   {
$event->cancel();
   }

// Here the code to cancel fall and fire damage
public function onDamage(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) {
            if ($event->getCause() === EntityDamageEvent::CAUSE_FALL || $event->getCause() === EntityDamageEvent::CAUSE_FIRE || $event->getCause() === EntityDamageEvent::CAUSE_LAVA || $event->getCause() === EntityDamageEvent::CAUSE_FIRE_TICK) $event->cancel();
        }
    }

// Here the code to cancel fire and lava damage
public function onBlockDamage(EntityDamageByBlockEvent $event)
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) {
            $player = $entity;
            if ($event->getCause() === EntityDamageByBlockEvent::CAUSE_FIRE) {
                $player->extinguish();
                $event->cancel();
            }
            if ($event->getCause() === EntityDamageByBlockEvent::CAUSE_LAVA) {
                $player->extinguish();
                $event->cancel();
            }
        }
    }

    /**
     * @priority HIGHEST
     */
    public function onQuit(PlayerQuitEvent $event): void {
        SessionFactory::removeSession($event->getPlayer());
    }

}
