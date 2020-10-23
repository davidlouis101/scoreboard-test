<?php

namespace Scoreboard;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\plugin\Plugin;
use pocketmine\Player;
use pocketmine\Server;
//Scoreboard Uses
use Scoreboard\Scoreboard;
use Scoreboard\ScoreboardTask;
use pocketmine\scheduler\Task as PluginTask;

class Main extends PluginBase implements Listener {
	
	public function onEnable() {
		$this->getLogger()->alert("§aScoreboard Aktiv");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask($this), 20);
	}
	
	//Scoreboard
	public function scoreboard(): void {
		foreach($this->getServer()->getOnlinePlayers() as $players) {
			$name = $players->getName();
			$echo = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
			$money = $echo->myMoney($players);
			$ping = $players->getPing();
			$id = $players->getInventory()->getItemInHand()->getId();
			$meta = $players->getInventory()->getItemInHand()->getDamage();
			$online = count($players->getServer()->getOnlinePlayers());
			//Create
			Scoreboard::removeScoreboard($players, "yt");
			Scoreboard::createScoreboard($players, "§l§7««§a§oFuture§fCraft§r§l§7»»", "yt");
			//Set Entrys
			Scoreboard::setScoreboardEntry($players, 1, "§k§a§lfff", "yt");
			Scoreboard::setScoreboardEntry($players, 2, "§9Name", "yt");
			Scoreboard::setScoreboardEntry($players, 3, "§7»§d$name", "yt");
			Scoreboard::setScoreboardEntry($players, 4, "§k§a§lddd", "yt");
			Scoreboard::setScoreboardEntry($players, 5, "§9Kontostand", "yt");
			Scoreboard::setScoreboardEntry($players, 6, "§7»§d$money", "yt");
			Scoreboard::setScoreboardEntry($players, 7, "§k§a§lqqq", "yt");
			Scoreboard::setScoreboardEntry($players, 8, "§9ItemID", "yt");
			Scoreboard::setScoreboardEntry($players, 9, "§7»§d$id §7: §d$meta", "yt");
			Scoreboard::setScoreboardEntry($players, 10, "§k§a§lccc", "yt");
			Scoreboard::setScoreboardEntry($players, 11, "§9§lPing", "yt");
			Scoreboard::setScoreboardEntry($players, 12, "§7»§d$ping", "yt");
			Scoreboard::setScoreboardEntry($players, 13, "§k§a§lbbb", "yt");
			Scoreboard::setScoreboardEntry($players, 14, "§7»§9§lOnline§7 »»§d$online / 20", "yt");
			Scoreboard::setScoreboardEntry($players, 15, "§k§a§laaa", "yt");
		}
	}
	
	public function onDisable() {
		$this->getLogger()->alert("§c§lScoreboard Plugin Deaktiviert");
	}
}
