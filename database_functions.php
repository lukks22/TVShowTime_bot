<?php


function userExists ( $bot, $chat_id ) {

  $sql = $bot -> getPdo() -> query ( "SELECT COUNT (*) FROM public.\"User\" WHERE chat_id = $chat_id;" );
  $number = $sql -> fetch ( PDO::FETCH_NUM );

  if ( (int)$number[0] == 0 ){
    return 0;
  }
  else {
    return 1;
  }
}

function addInfo( $bot, $chat_id, $user_lang ) {
  $sql = $bot -> getPdo() -> query ( "INSERT INTO public.\"User\" (chat_id,\"user_lang\") VALUES ($chat_id,'$user_lang');" );

  echo "ho inserito $chat_id con lingua $user_lang";
}

function delID( $bot ) {
  $sql = $bot -> getPdo() -> query ( "DELETE FROM \"User\";" );
}
