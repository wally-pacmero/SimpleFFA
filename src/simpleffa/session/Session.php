<?php
/* 
 * Copyright (C) Sergittos - All Rights Reserved 
 * Unauthorized copying of this file, via any medium is strictly prohibited 
 * Proprietary and confidential 
 */

declare(strict_types=1);


namespace simpleffa\session;

use pocketmine\player\Player;

class Session {

    private Player $player;

    public function __construct(Player $player) {
            }
        });
        $this->player = $player;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

}
