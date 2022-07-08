<?php

namespace simpleffa;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use simpleffa\session\SessionFactory;

class Loader extends PluginBase {
 use SingletonTrait;

 protected function onLoad(): void {
        self::setInstance($this);
    }

 public function onEnable(): void {
        $this->registerListener(new FFAListener());
        foreach(SessionFactory::getInstance()->getSessions() as $session) {
        $session->changeScoreboard();
        }
    }
 private function registerListener(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }
}
