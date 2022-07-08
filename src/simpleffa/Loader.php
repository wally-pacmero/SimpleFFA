<?php

namespace simpleffa;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Loader extends PluginBase {
 use SingletonTrait;

 protected function onLoad(): void {
        self::setInstance($this);
    }

 public function onEnable(): void {
        $this->registerListener(new FFAListener());
    }
 private function registerListener(Listener $listener): void {
        $this->getServer()->getPluginManager()->registerEvents($listener, $this);
    }
}
