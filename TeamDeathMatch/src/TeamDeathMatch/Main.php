<?php 

namespace TeamDeathMatch;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

use TeamDeathMatch\events\EventsManager;

class Main extends PluginBase implements Listener{

public $setter = array();
public $map = array();

public function onEnable(){
	@mkdir($this->getDataFolder());
	$this->settings = new Config($this->getDataFolder()."settings.yml", Config::YAML, array());
	$this->areans = new Config($this->getDataFolder()."areans.yml", Config::YAML, array("Maps" => array("Map-1")));
	foreach($this->areans->get("Maps") as $m){
	$this->maps[$m] = $this->settings->get("game-time");	
	}
	$this->getServer()->getLogger()->info("[TeamDeathMatch]Loaded");
	$this->getServer()->getPluginManager()->registerEvents(new EventsManager($this),$this);
}

public function onDisable(){
}

public function giveItems(Player $player){
	$inv = $player->getInventory();
	
	$inv->setContents([]);
	/* by item id */
	$h = $this->settings->get("helmet");
	$c = $this->settings->get("chestplate");
	$l = $this->settings->get("leggings");
	$b = $this->settings->get("boots");
	
	$inv->setHelmet($h[0],$h[1],$h[2]);
	$inv->setChestplate($c[0],$c[1],$c[2]);
	$inv->setLeggings($l[0],$l[1],$l[2]);
	$inv->setBoots($b[0],$b[1],$b[2]);
}

/*SOONpublic function sendMessage(Player $player,$message){
	if($this->settings->get("message-type") === "popup"){
		$p->sendpopup($message);
	}
	
}*/

public function runMatches(){
	foreach($this->arenas->get("Maps") as $m){
		$level = $this->getServer()->getLevelByName($m);
		$this->maps[$m]--;
		if($level !== null){
			foreach($level->getPlayers() as $p){
				if($this->maps[$m] === 0){
					//TODO: match stopping
				}
			//SOON: $this->sendMessage($p,$this->maps[$m]);
				
			}
		}
	}
}

}