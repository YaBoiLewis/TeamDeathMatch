<?php
namespace TeamDeathMatch\tasks;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\Player;

class GameTask extends PluginTask{

private $plugin;
	
	public function __construct(Plugin $owner){
		parent::__construct($owner);
		$this->player = $player;
	}
	
}