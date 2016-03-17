<?php 

namespace TeamDeathMatch;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

use TeamDeathMatch\events\EventsManager;
use TeamDeathMatch\tasks\GameTask;

class Main extends PluginBase implements Listener{

public $setter = array();
public $map = array();
public $maps = array();
public $score = array();

public $redPlayers = array();
public $bluePlayers = array();

public function onEnable(){
	@mkdir($this->getDataFolder());
	$this->settings = new Config($this->getDataFolder()."settings.yml", Config::YAML, array("score-to-win" => 30,"game-time" => 900,"message-type" => "popup","prefix" => "[TDM]","helmet" => array(1,1,1),"chestplate" => array(1,1,1),"leggings" => array(1,1,1),"boots" => array(1,1,1)));
	$this->areans = new Config($this->getDataFolder()."areans.yml", Config::YAML, array("Maps" => array("Map-1")));
	foreach($this->areans->get("Maps") as $m){
	$this->maps[$m] = $this->settings->get("game-time");	
	}
	$this->getServer()->getLogger()->info("[TeamDeathMatch]Loaded");
	$this->getServer()->getPluginManager()->registerEvents(new EventsManager($this),$this);
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new GameTask($this),20); 
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

public function sendMessageType(Player $player,$message){
	if($this->settings->get("message-type") === "popup"){
		$p->sendpopup($message);
	}else{
		$p->sendTip($message);
	}
	
}

public function pickTeam($map,Player $player){
	if(count($this->bluePlayers[$map]) < count($this->redPlayers[$map])){
		$this->bluePlayers[$map][$player->getName()] = array("Player" => $player->getName());
	}else{
		$this->redPlayers[$map][$player->getName()] = array("Player" => $player->getName());
	}
}

public function checkScore($map){
	if(!in_array($map, $this->score)){
		return;
	}
	if($this->score[$map]["BlueTeam"] === $this->settings->get("score-to-win")){
		
	}
	if($this->score[$map]["RedTeam"] === $this->settings->get("score-to-win")){
		
	}
}

public function nextPoint($map,Player $player){
	if(isset($this->bluePlayers[$map][$player->getName()])){
		$this->score[$map]["BlueTeam"]++;
	}
	if(isset($this->redPlayers[$map][$player->getName()])){
		$this->score[$map]["RedTeam"]++;
	}
}

public function runMatches(){
	foreach($this->areans->get("Maps") as $m){
		$level = $this->getServer()->getLevelByName($m);
		$this->maps[$m]--;
		if($level !== null){
			foreach($level->getPlayers() as $p){
				if($this->maps[$m] === 0){
					//TODO: match stopping
				}
			$this->sendMessageType($p,$this->maps[$m]);
				
			}
		}
	}
}

}
