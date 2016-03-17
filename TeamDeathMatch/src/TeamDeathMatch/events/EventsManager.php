<?php

namespace TeamDeathMatch\events;

use pocketmine\event\Listener;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\player\PlayerInteractEvent;

use TeamDeathMatch\Main;

use pocketmine\utils\TextFormat as TF;

class EventsManager implements Listener{
	
	private $plugin;
	
	public function __construct(Main $plugin) {
		$this->plugin = $plugin;
		$this->settings = $this->plugin->settings;
		$this->map = $this->plugin->map;
		$this->areans = $this->plugin->areans;
	}
	
	public function onInteract(PlayerInteractEvent $ev){
		$p = $ev->getPlayer();
		$block = $ev->getBlock();
		$usrname = $p->getName();
		if(isset($this->plugin->setter[$usrname])){
			switch($this->plugin->setter[$usrname]){
				case 0:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("sign[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				
				case 1:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos1[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 2:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos2[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 3:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos3[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 4:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos4[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 5:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos5[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 6:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos6[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 7:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos8[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 8:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos8[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 9:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
				$this->settings->set("pos9[{$this->map[$usrname]}]",$this->array);
				$this->setter[$usrname]++;
				$p->sendMessage(TF::GREEN."Created position!");
				break;
				case 10:
				$this->array = array("x" => $block->getX(),
				"y" => $block->getY(),
				"z" => $block->getZ());
			$this->settings->set("pos10[{$this->map[$usrname]}]",$this->array);
				$this->settings->save();
				$p->sendMessage(TF::GREEN."All positions done!");
				unset($this->setter[$usrname]);
				unset($this->map[$usrname]);
				break;
			}
		}else{
	$sign = $p->getLevel()->getTile($block);
	foreach($this->areans->get("Maps") as $map){
if($ev->getAction() === PlayerInteractEvent::RIGHT_CLICK_BLOCK && $this->settings->exists("pos10[{$map}]") && $sign instanceof \pocketmine\tile\Sign && $sign->getY() === $this->settings->get("sign[{$map}]")["y"] && $sign->getX() === $this->settings->get("sign[{$map}]")["x"] && $sign->getZ() === $this->settings->get("sign[{$map}]")["z"]){
	if(count($this->plugin->getServer()->getLevelByName($map)->getPlayers()) === 10){
		$p->sendMessage(TF::RED."Match full!");
		return;
	}else{
		$p->setLevel($this->plugin->getServer()->getLevelByName($this->settings->get("sign[{$map}]")["level"]));
		$this->plugin->pickTeam($map,$p);
	}
}
}
	}
	}
	
}