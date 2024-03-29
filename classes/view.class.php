<?php

class View
{
  // 清空螢幕畫面
  public static function clearScreen()
  {
    echo "\033[2J\033[H";
  }

  // 離開遊戲畫面
  public static function exitGame()
  {
    self::clearScreen();
    echo "Thanks for playing!\n";
    exit;
  }

  // 進入開始遊戲畫面
  public static function getMenu($recordsInDB)
  {
    self::clearScreen();
    echo "歡迎來到對戰遊戲!\n";
    echo "(1)新建角色並開始對戰\n";
    echo "(2)查看歷史記錄\n";
    echo "(3)離開遊戲\n";
    $choice = readline("請輸入你的選項: ");
    if ($choice == "1") {
      return;
    } else if ($choice == "2") {
      self::getRecords($recordsInDB);
      readline("按下Enter後回到menu...\n");
      self::getMenu($recordsInDB);
    } else if ($choice == "3") {
      self::exitGame();
    } else {
      readline("輸入的選項無效，請按下Enter後重新輸入！\n");
      self::getMenu($recordsInDB);
    }
  }

  // 進入關卡
  public static function getGameLevel($enemy, $gameLevel)
  {
    self::clearScreen();
    echo '進入第' . $gameLevel . '關' . "\n";
    echo '第' . $gameLevel . '關敵人為' . $enemy->name . "\n";
  }

  // 更新對戰資訊
  public static function updateInfo($player, $enemy)
  {
    self::clearScreen();
    printf("%-20s| %-20s\n", 'Player', 'Enemy');
    printf("%'-40s\n", '');
    printf("%-20s| %-20s\n", 'HP:' . $player->healthPoint, 'HP:' . $enemy->healthPoint);
  }

  // 取得對戰結果
  public static function getResult($gameLevel, $winner)
  {
    echo '第' . $gameLevel . '關挑戰結果：' . $winner->name . '勝利' . "\n";
  }

  // 宣布玩家勝利
  public static function announcePlayerVictory()
  {
    echo '10關全數通過！玩家闖關成功！' . "\n";
  }

  // 顯示全部遊戲紀錄
  public static function getRecords($recordsInDB)
  {
    self::clearScreen();
    foreach ($recordsInDB as $recordInDB) {
      echo '玩家名稱：' . $recordInDB['player_name'] . ' / 通關數：' . $recordInDB['level_passed'] . ' / 開始時間：' . $recordInDB['start_time'] . ' / 結束時間：' . $recordInDB['end_time'] . "\n";
    }
  }
}
