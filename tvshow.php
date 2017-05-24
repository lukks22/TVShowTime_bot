<?php

require './vendor/autoload.php';
$token="xxxx";
$bot = new PhpBotFramework\Bot($token);
$bot -> redis = new Redis();
$bot -> redis -> connect('127.0.0.1');
$bot -> database->connect(
  [
    'adapter' => 'pgsql',
    'username' => 'postgres',
    'password' => 'tvshow',
    'dbname' => 'tvshow'
  ]
);

$notifications_stat = true;
echo "online \n";


$home = new PhpBotFramework\Commands\MessageCommand("start", function($bot, $message){
  $chat_id = $bot -> getChatId();
  //if !($bot -> redis > setNx("users", $chat_id) ) {
    x_home:
    $bot -> keyboard -> addLevelButtons(
      [
        "text" => "🔍 Search",
        "callback_data" => "home_search"
      ],
      [
        "text" => "🎞 Your Series",
        "callback_data" => "home_series"
      ]
    );
   $bot -> keyboard -> addLevelButtons(
      [
        "text" => "📆 Calendar",
        "callback_data" => "home_cal"
      ]
    );
   $bot -> keyboard -> addLevelButtons(
      [
        "text" => "👤 Profile",
        "callback_data" => "home_profile"
      ],
      [
        "text" => "⚙️ Settings",
        "callback_data" => "home_settings"
      ]
    );
    $bot -> sendMessage( "Welcome in <b>TV Show Time bot!</b> \n\nThis bot allows you to manage your favourite TV Series.\nPlease, press one of the following buttons to continue", $bot -> keyboard -> get() );
  }
  # aggiungere else()
);
$bot -> addCommand($home);


$settings = new PhpBotFramework\Commands\CallbackCommand ( "home_settings", function($bot, $callback_query ) {
  $chat_id = $bot -> getChatId();
  x_settings:
  if ( $bot -> redis -> get ( $chat_id . " notifications" ) == "true" ) {
    $bot -> keyboard -> addLevelButtons(
      [
        "text" => "✅ Notifications",
        "callback_data" => "change_notifications"
      ]
    );
  }
  else {
    $bot -> keyboard -> addLevelButtons(
      [
        "text" => "❌ Notifications",
        "callback_data" => "change_notifications"
      ]
    );
  }
  $bot -> keyboard -> addLevelButtons(
    [
      "text" => "🌐 Language",
      "callback_data" => "change_language"
    ],
    [
      "text" => "🤓 Info",
      "callback_data" => "settings_info"
    ]
  );
  $bot -> keyboard -> addLevelButtons(
    [
      "text" => "↩️ Back",
      "callback_data" => "settings_home"
    ]
  );

  $bot -> editMessageText ( $callback_query["message"]["message_id"], "<b>Red cable or blue one?</b>\n<i>Pay attention, your choices will change the world!</i>\n\nNah, just kidding. They will only change your user experience.\n<b>What do you want to do?</b>", $bot -> keyboard -> get() );

  }
);
$bot -> addCommand ( $settings );

$notifications_change = new PhpBotFramework\Commands\CallbackCommand( "change_notifications", function ( $bot, $callback_query){
  if ( $bot -> redis -> get ( $chat_id . " notifications" ) == "true" ) {
    $bot -> redis -> set ( $chat_id . " notifications", "false" );
    goto x_settings;
  }
  else {
    $bot -> redis -> set ( $chat_id . " notifications", "false");
    goto x_settings;
  }
}
);
$bot -> addCommand ( $notifications_change );



$bot -> getUpdatesLocal();
