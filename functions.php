<?php
//------------------------------------------------------------
//
// NOTE:
//
// Try NOT to add any code line in this file.
//
// Use "app\Main.php" to add your hooks.
//
//------------------------------------------------------------
require_once( __DIR__ . '/app/Boot/bootstrap.php' );
function change_title_text( $title ){
     $screen = get_current_screen();
  
     if  ( 'files' == $screen->post_type ) {
          $title = 'Thêm tên tập tin';
     }
	 else if( 'document' == $screen->post_type ) {
          $title = 'Nhập tiêu đề tài liệu';
     }
  
     return $title;
}
  
add_filter( 'enter_title_here', 'change_title_text' );