<?php

namespace ghost\GamemodeUI;


use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class GamemodeUI extends PluginBase implements Listener {

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("GamemodeUI Load");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
       $commandname = $command->getName();
       if($commandname == "gmui"){
           if($sender instanceof Player){
               $this->gmui($sender);
           }
       }
    return true;
    }

    public function gmui(Player $player){
        $form = new SimpleForm(function (Player $player, int $data = null){
            if($data === null){
                return;
            }
            switch($data){
                case 0:
                    $player->setGamemode(GameMode::SURVIVAL());
                    $player->sendMessage("§9»Gamemode selected: §esurvival");

                break;

                case 1:
                    $player->setGamemode(GameMode::CREATIVE());
                    $player->sendMessage("§9»Gamemode selected: §eCreative");
                break;

                case 2:
                    $player->setGamemode(GameMode::ADVENTURE());
                    $player->sendMessage("§9»Gamemode selected: §eAdventure");
                break;

                case 3:
                    $player->setGamemode(GameMode::SPECTATOR());
                    $player->sendMessage("§9»Gamemode selected: §eSpectator");
                break;
            }
        });
        $form->setTitle("GamemodeUI");
        $form->addButton("Survival");
        $form->addButton("Creative");
        $form->addButton("Adventure");
        $form->addButton("Spectator");
        $player->sendForm($form);
        return $form;
    }
}