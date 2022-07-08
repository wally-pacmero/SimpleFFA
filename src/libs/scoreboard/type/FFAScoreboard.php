<?php

namespace libs\scoreboard\type;

use pocketmine\Server;
use pocketmine\player\Player;

use libs\scoreboard\Scoreboard;

use simpleffa\Loader;

class FFAScoreboard extends Scoreboard
{
  
  public function __construct(Player $player)
  {
    parent::__construct($player);
  }
  
  public function show(): void
  {
    parent::spawn();
  }
  
  public function showLines(): void
  {
    parent::setLine(1, TextFormat::colorize(""));
    parent::setLine(2, TextFormat::colorize(" &bOnline: &f" . count(Server::getInstance()->getOnlinePlayers())));
    parent::setLine(3, TextFormat::colorize(" &bPing: &f" . parent::getPlayer()->getNetworkSession()->getPing()));
    parent::setLine(4, TextFormat::colorize("§f"));
  }
  
}
