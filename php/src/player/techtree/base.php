<?php
namespace SteamDB\CTowerAttack\Player\TechTree;

class Base
{
	/*
	repeated Upgrade upgrades = 1;		
	optional double damage_per_click = 2 [default = 1.0];
	optional double damage_multiplier_fire = 3 [default = 1.0];
	optional double damage_multiplier_water = 4 [default = 1.0];
	optional double damage_multiplier_air = 5 [default = 1.0];
	optional double damage_multiplier_earth = 6 [default = 1.0];
	optional double damage_multiplier_crit = 7 [default = 2.0];
	optional uint64 unlocked_abilities_bitfield = 8 [default = 0];
	optional double hp_multiplier = 9 [default = 1.0];
	optional double crit_percentage = 10 [default = 0];
	optional double badge_points = 11;
	repeated AbilityItem ability_items = 12;
	optional double boss_loot_drop_percentage = 13 [default = 0.25];
	optional double damage_multiplier_dps = 14 [default = 1.0];
	optional double base_dps = 15;
	optional double damage_per_click_multiplier = 16 [default = 1.0];
	optional double max_hp = 17;
	optional double dps = 18;
	*/
	private $Upgrades = array();
	private $DamagePerClick = 1.0;
	private $DamageMultiplierFire = 1.0;
	private $DamageMultiplierWater = 1.0;
	private $DamageMultiplierAir = 1.0;
	private $DamageMultiplierEarth = 1.0;
	private $DamageMultiplierCrit = 2.0;
	private $UnlockedAbilitiesBitfield = 0;
	private $HpMultiplier = 1.0;
	private $CritPercentage = 0;
	private $BadgePoints = 0;
	private $AbilityItems = array();
	private $BossLootDropPercentage = 0.25;
	private $DamageMultiplierDps = 1.0;
	private $BaseDps = 0;
	private $DamagePerClickMultiplier = 1.0;
	private $MaxHp = 0;
	private $Dps = 0;
	
	public function __construct( 
		$Upgrades = array(),
		$DamagePerClick = 1.0,
		$DamageMultiplierFire = 1.0,
		$DamageMultiplierWater = 1.0,
		$DamageMultiplierAir = 1.0,
		$DamageMultiplierEarth = 1.0,
		$DamageMultiplierCrit = 2.0,
		$UnlockedAbilitiesBitfield = 0,
		$HpMultiplier = 1.0,
		$CritPercentage = 0,
		$BadgePoints = 0,
		$AbilityItems = array(),
		$BossLootDropPercentage = 0.25,
		$DamageMultiplierDps = 1.0,
		$BaseDps = 0,
		$DamagePerClickMultiplier = 1.0,
		$MaxHp = 0,
		$Dps = 0
	) {
		$this->Upgrades = array();
		foreach( \SteamDB\CTowerAttack\Server::GetTuningData( 'upgrades' ) as $UpgradeId => $Upgrade) {
			$this->Upgrades[] = new Upgrade( $UpgradeId, 0, $Upgrade[ 'cost' ] );
		}
		$this->DamagePerClick = $DamagePerClick;
		$this->DamageMultiplierFire = $DamageMultiplierFire;
		$this->DamageMultiplierWater = $DamageMultiplierWater;
		$this->DamageMultiplierAir = $DamageMultiplierAir;
		$this->DamageMultiplierEarth = $DamageMultiplierEarth;
		$this->DamageMultiplierCrit = $DamageMultiplierCrit;
		$this->UnlockedAbilitiesBitfield = $UnlockedAbilitiesBitfield;
		$this->HpMultiplier = $HpMultiplier;
		$this->CritPercentage = $CritPercentage;
		$this->BadgePoints = $BadgePoints;
		$this->AbilityItems = $AbilityItems;
		$this->BossLootDropPercentage = $BossLootDropPercentage;
		$this->DamageMultiplierDps = $DamageMultiplierDps;
		$this->BaseDps = $BaseDps;
		$this->DamagePerClickMultiplier = $DamagePerClickMultiplier;
		$this->MaxHp = $MaxHp;
		$this->Dps = $Dps;
	}

	public function ToArray()
	{
		return array(
			"upgrades" => $this->GetUpgradesArray(),
			"damage_per_click" => $this->GetDamagePerClick(),
			"damage_multiplier_fire" => $this->GetDamageMultiplierFire(),
			"damage_multiplier_water" => $this->GetDamageMultiplierWater(),
			"damage_multiplier_air" => $this->GetDamageMultiplierAir(),
			"damage_multiplier_earth" => $this->GetDamageMultiplierEarth(),
			"damage_multiplier_crit" => $this->GetDamageMultiplierCrit(),
			"unlocked_abilities_bitfield" => $this->GetUnlockedAbilitiesBitfield(),
			"hp_multiplier" => $this->GetHpMultiplier(),
			"crit_percentage" => $this->GetCritPercentage(),
			"badge_points" => $this->GetBadgePoints(),
			"ability_items" => $this->GetAbilityItems(),
			"boss_loot_drop_percentage" => $this->GetBossLootDropPercentage(),
			"damage_multiplier_dps" => $this->GetDamageMultiplierDps(),
			"damage_per_click_multiplier" => $this->GetDamagePerClickMultiplier(),
			"max_hp" => $this->GetMaxHp(),
			"dps" => $this->GetDps()
		);
	}

	public function GetElementalUpgrades()
	{
		return array(
			3 => $this->GetUpgrade( 3 ), // Fire
			4 => $this->GetUpgrade( 4 ), // Water
			5 => $this->GetUpgrade( 5 ), // Air
			6 => $this->GetUpgrade( 6 ) // Earth
		);
	}

	public function GetUpgrade( $UpgradeId )
	{
		return $this->Upgrades[ $UpgradeId ];
	}

	public function GetUpgrades()
	{
		return $this->Upgrades;
	}

	public function GetUpgradesArray()
	{
		$Upgrades = array();
		foreach( $this->GetUpgrades() as $Upgrade ) {
			$Upgrades[] = $Upgrade->ToArray();
		}
		return $Upgrades;
	}

	public function GetDamagePerClick()
	{
		return $this->DamagePerClick;
	}

	public function GetDamageMultiplierFire()
	{
		return $this->DamageMultiplierFire;
	}

	public function GetDamageMultiplierWater()
	{
		return $this->DamageMultiplierWater;
	}

	public function GetDamageMultiplierAir()
	{
		return $this->DamageMultiplierAir;
	}

	public function GetDamageMultiplierEarth()
	{
		return $this->DamageMultiplierEarth;
	}

	public function GetDamageMultiplierCrit()
	{
		return $this->DamageMultiplierCrit;
	}

	public function GetUnlockedAbilitiesBitfield()
	{
		return $this->UnlockedAbilitiesBitfield;
	}

	public function GetHpMultiplier()
	{
		return $this->HpMultiplier;
	}

	public function GetCritPercentage()
	{
		return $this->CritPercentage;
	}

	public function GetBadgePoints()
	{
		return $this->BadgePoints;
	}

	public function GetAbilityItems()
	{
		return $this->AbilityItems;
	}

	public function GetBossLootDropPercentage()
	{
		return $this->BossLootDropPercentage;
	}

	public function GetDamageMultiplierDps()
	{
		return $this->DamageMultiplierDps;
	}

	public function GetBaseDps()
	{
		return $this->BaseDps;
	}

	public function GetDamagePerClickMultiplier()
	{
		return $this->DamagePerClickMultiplier;
	}

	public function GetMaxHp()
	{
		return $this->MaxHp;
	}

	public function GetDps()
	{
		return $this->Dps;
	}
}
?>