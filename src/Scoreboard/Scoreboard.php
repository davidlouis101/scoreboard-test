<?php

declare(strict_types=1);

namespace Scoreboard;

use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;
use pocketmine\Player;

class Scoreboard
{
    public static function setScoreboardEntry(Player $player, int $score, string $msg, string $objName) : void
    {
        $entry = new ScorePacketEntry();
        $entry->objectiveName = $objName;
        $entry->type = 3;
        $entry->customName = " $msg   ";
        $entry->score = $score;
        $entry->scoreboardId = $score;
        $packet = new SetScorePacket();
        $packet->type = 0;
        $packet->entries[$score] = $entry;
        $player->sendDataPacket($packet);
    }

    public static function removeScoreboardEntry(Player $player, int $score) : void
    {
        $packet = new SetScorePacket();
        if (isset($packet->entries[$score]))
        {
            unset($packet->entries[$score]);
            $player->sendDataPacket($packet);
        }
    }

    public static function createScoreboard(Player $player, string $title, string $objName, string $slot = "sidebar", $order = 0) : void
    {
        $packet = new SetDisplayObjectivePacket();
        $packet->displaySlot = $slot;
        $packet->objectiveName = $objName;
        $packet->displayName = $title;
        $packet->criteriaName = "dummy";
        $packet->sortOrder = $order;
        $player->sendDataPacket($packet);
    }

    public static function removeScoreboard(Player $player, string $objName) : void
    {
        $packet = new RemoveObjectivePacket();
        $packet->objectiveName = $objName;
        $player->sendDataPacket($packet);
    }
}
