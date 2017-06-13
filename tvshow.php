<?php


require "keyboard_functions.php";
require "database_functions.php";
require "./vendor/autoload.php";


$token="xxxx";

$bot = new PhpBotFramework\Bot($token);

$bot -> database -> connect(
  [
    'adapter' => 'pgsql',
    'username' => 'postgres',
    'password' => 'xxxx',
    'dbname' => 'yyyy'
  ]
);

echo "online \n";



$home = new PhpBotFramework\Commands\MessageCommand("start", function($bot, $message){
  $chat_id = $bot -> getChatId();
  if ( userExists( $bot, $chat_id ) ){
    $message = "Welcome in <b>TV Show Time bot!</b> \n\nThis bot allows you to manage your favourite TV Series.\nPlease, press one of the following buttons to continue";
  }
  else {
    $message = "Hey there! \n\nThanks for using me! Before we start, could you tell me what language do you like the most?\n\n<i>Unfortunately, my main language is English, but I can speak in these language a bit. Just give me a chance!</i>";
  }
  home_keyboard ( $bot, $message, $chat_id );

  }
);
$bot -> addCommand($home);


$settings = new PhpBotFramework\Commands\CallbackCommand ( "home_settings", function($bot, $callback_query ) {

  $chat_id = $bot -> getChatId();
  //$message="<b>Red cable or blue one?</b>\n<i>Pay attention, your choices will change the world!</i>\n\nNah, just kidding. They will only change your user experience.\n<b>What do you want to do?</b>";

  settings_keyboard( $bot, $callback_query );

  }
);
$bot -> addCommand ( $settings );

$settings_home = new PhpBotFramework\Commands\CallbackCommand ( "settings_home", function($bot, $callback_query) {
  $chat_id = $bot -> getChatId();
  $message = "Welcome in <b>TV Show Time bot!</b> \n\nThis bot allows you to manage your favourite TV Series.\nPlease, press one of the following buttons to continue";

  go_home( $bot, $message, $callback_query );
}
);
$bot->addCommand( $settings_home );

$del = new PhpBotFramework\Commands\MessageCommand ("del", function($bot, $message){
  $chat_id = $bot -> getChatId();
  if ($chat_id == 198478957) {
    delID($bot);
    $bot -> sendMessage("deleted");
  }
  else {
    $bot -> sendMessage("Not authorized");
  }
}
);
$bot -> addCommand($del);

$language_en = new PhpBotFramework\Commands\CallbackCommand ( "en", function($bot, $callback_query){
  $chat_id = $bot -> getChatId();
  $user_lang = "en";
  addInfo( $bot, $chat_id, $user_lang );
  go_home($bot, $callback_query);
}
);
$bot -> addCommand($language_en);

$language_it = new PhpBotFramework\Commands\CallbackCommand ( "it", function($bot, $callback_query){
  $chat_id = $bot -> getChatId();
  $user_lang = "it";
  addInfo( $bot, $chat_id, $user_lang );
  go_home($bot, $callback_query);
}
);
$bot -> addCommand($language_it);

$language_fr = new PhpBotFramework\Commands\CallbackCommand ( "fr", function($bot, $callback_query){
  $chat_id = $bot -> getChatId();
  $user_lang = "fr";
  addInfo( $bot, $chat_id, $user_lang );
  go_home($bot, $callback_query);
}
);
$bot -> addCommand($language_fr);

$language_es = new PhpBotFramework\Commands\CallbackCommand ( "es", function($bot, $callback_query){
  $chat_id = $bot -> getChatId();
  $user_lang = "es";
  addInfo( $bot, $chat_id, $user_lang );
  go_home($bot, $callback_query);
}
);
$bot -> addCommand($language_es);

$language_pt = new PhpBotFramework\Commands\CallbackCommand ( "pt", function($bot, $callback_query){
  $chat_id = $bot -> getChatId();
  $user_lang = "pt";
  addInfo( $bot, $chat_id, $user_lang );
  go_home($bot, $callback_query);
}
);
$bot -> addCommand($language_pt);

$bot -> getUpdatesLocal();
