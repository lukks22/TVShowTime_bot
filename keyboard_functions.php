<?php

$keyboard = [];

function home_keyboard ( $bot, $message, $chat_id ) {
if (userExists($bot,$chat_id)){
  $keyboard[0] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"🔍 Search\",
                    \"callback_data\" => \"home_search\"
                  ],
                  [
                    \"text\" => \"🎞 Your Series\",
                    \"callback_data\" => \"home_series\"
                  ]
                );";

  $keyboard[1] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"📆 Calendar\",
                    \"callback_data\" => \"home_cal\"
                  ]
                );";

  $keyboard[2] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"👤 Profile\",
                    \"callback_data\" => \"home_profile\"
                  ],
                  [
                    \"text\" => \"⚙️ Settings\",
                    \"callback_data\" => \"home_settings\"
                  ]
                );";

  eval($keyboard[0]);
  eval($keyboard[1]);
  eval($keyboard[2]);
  return $bot -> sendMessage ( $message, $bot -> keyboard -> get() );
}

else{

  $keyboard[0] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"🇮🇹\",
                    \"callback_data\" => \"it\"
                  ],
                  [
                    \"text\" => \"🇬🇧\",
                    \"callback_data\" => \"en\"
                  ],
                  [
                    \"text\" => \"🇪🇸\",
                    \"callback_data\" => \"es\"
                  ],
                  [
                    \"text\" => \"🇫🇷\",
                    \"callback_data\" => \"fr\"
                  ],
                  [
                    \"text\" => \"🇵🇹\",
                    \"callback_data\" => \"pt\"
                  ]
                );";
  eval($keyboard[0]);
  return $bot -> sendMessage ( $message, $bot -> keyboard -> get() );

}
}


function settings_keyboard ( $bot, $message, $callback_query ) {

  $keyboard[0] = "$" . "bot -> keyboard -> addLevelButtons(
                    [
                      \"text\" => \"🌐 Language\",
                      \"callback_data\" => \"change_language\"
                    ],
                    [
                      \"text\" => \"🤓 Info\",
                      \"callback_data\" => \"settings_info\"
                    ]
                  );";

  $keyboard[1] = "$" . "bot -> keyboard -> addLevelButtons(
                    [
                      \"text\" => \"↩️ Back\",
                      \"callback_data\" => \"settings_home\"
                    ]
                  );";

  eval ( $keyboard[0] );
  eval ( $keyboard[1] );

  return $bot -> editMessageText ( $callback_query["message"]["message_id"], $message, $bot -> keyboard -> get() );
}

function go_home ( $bot, $callback_query) {
  $keyboard[0] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"🔍 Search\",
                    \"callback_data\" => \"home_search\"
                  ],
                  [
                    \"text\" => \"🎞 Your Series\",
                    \"callback_data\" => \"home_series\"
                  ]
                );";

  $keyboard[1] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"📆 Calendar\",
                    \"callback_data\" => \"home_cal\"
                  ]
                );";

  $keyboard[2] = "$" . "bot -> keyboard -> addLevelButtons(
                  [
                    \"text\" => \"👤 Profile\",
                    \"callback_data\" => \"home_profile\"
                  ],
                  [
                    \"text\" => \"⚙️ Settings\",
                    \"callback_data\" => \"home_settings\"
                  ]
                );";
  eval($keyboard[0]);
  eval($keyboard[1]);
  eval($keyboard[2]);
  $message = "Welcome in <b>TV Show Time bot!</b> \n\nThis bot allows you to manage your favourite TV Series.\nPlease, press one of the following buttons to continue";
  return $bot -> editMessageText ( $callback_query["message"]["message_id"], $message, $bot -> keyboard -> get() );
}
