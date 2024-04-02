<?php

class Character
{
  // Properties
  public $name;
  public $healthPoint;
  public $physicalAttack;
  public $magicalAttack;
  public $physicalDefense;
  public $magicalDefense;
  public $magicValue;
  public $luckValue;
  private $criticalHitFactor;

  private function determineCriticalHit()
  {
    $this->criticalHitFactor = rand(1, 100);
    return $this->criticalHitFactor <= ($this->luckValue) * 10;
  }

  public function launchPhysicalAttack($target)
  {
    if (self::determineCriticalHit()) {
      $target->healthPoint = $target->healthPoint - (($this->physicalAttack * 5) * 2 - $target->physicalDefense);
      echo "\n";
      echo '物理攻擊發動！產生爆擊傷害加倍！' . "\n";
    } else {
      $target->healthPoint = $target->healthPoint - (($this->physicalAttack * 5) - $target->physicalDefense);
      echo "\n";
      echo '物理攻擊發動！' . "\n";
    }
    sleep(1);
  }

  public function launchMagicalAttack($target)
  {
    // 若本身魔力量大於最小魔力消耗值(先固定為一次魔力攻擊消耗2點魔力)
    if ($this->magicValue >= 2) {
      $target->healthPoint = $target->healthPoint - (($this->magicalAttack * 5) - $target->magicalDefense);
      $this->magicValue -= 2;
      echo "\n";
      echo '魔法攻擊發動！' . "\n";
    } else {
      echo '無效攻擊！魔力量不足無法發動魔法攻擊！' . "\n";
    }
    sleep(1);
  }

  public function restoreMagicValue()
  {
    // 先假設魔力最大值是10點，每回合恢復1點
    if ($this->magicValue < 10) {
      $this->magicValue += 1;
    }
  }
}
