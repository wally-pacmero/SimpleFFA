<?php
/* 
 * Copyright (C) Sergittos - All Rights Reserved 
 * Unauthorized copying of this file, via any medium is strictly prohibited 
 * Proprietary and confidential 
 */

declare(strict_types=1);


namespace simpleffa\session;

use pocketmine\player\Player;
use libs\scoreboard\type\FFAScoreboard;
use libs\scoreboard\Scoreboard;
use pocketmine\utils\TextFormat;

class Session {

    private Player $player;

  /** @var Scoreboard **/
  private Scoreboard $scoreboard;

    public function __construct(Player $player) {
  $this->player = $player;
  $this->scoreboard = Scoreboard::create($player, "SimpleFFA");
$player->setNameTag(TextFormat::AQUA . $player->getName());       
            }
        

    public function getPlayer(): Player {
return $this->player;
}
public function getScoreboard(): Scoreboard
  {
    return $this->scoreboard;
  }
  
  public function isScoreboard(): bool
  {
    return isset($this->scoreboard);
  }
  
  public function setScoreboard(Scoreboard $scoreboard): void
  {
    if (!$this->getPlayer()->isOnline()) {
      return;
    }
    $this->scoreboard = $scoreboard;
    $scoreboard->spawn();
    $scoreboard->setAllLine(["line", " §fPing: " . $this->getPlayer()->getNetworkSession()->getPing(), "§7line"]);
  }
  
  public function changeScoreboard(): void
  {
    $this->setScoreboard($this->scoreboard);
  }

}
