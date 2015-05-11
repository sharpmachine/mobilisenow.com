<?php

#=================================================================
# CSS File Attachments
#=================================================================

/* ------------------- Bootstrap ------------------ */
wp_register_style('hwextpro-bootstrap', $hwextproInfo["dir-url"]."lib/bootstrap/css/bootstrap.min.css", false,'3.0');


/* ------------------- Jquery UI ------------------ */
wp_register_style('hwextpro-jquery-ui', $hwextproInfo["dir-url"]."css/jquery-ui.min.css", false,'1.10.3');


/* ------------------- Theme Style ------------------ */
wp_register_style('hwextpro-style', $hwextproInfo["dir-url"]."css/style.css", false,null);




#=================================================================
# JS File Attachments
#=================================================================

/* ------------------- Bootstrap ------------------ */
wp_register_script("hwextpro-bootstrap", $hwextproInfo["dir-url"]."lib/bootstrap/js/bootstrap.min.js", false, '3.0', false);


/* ------------------- Theme Js ------------------ */
wp_register_script("hwextpro-js-functions", $hwextproInfo["dir-url"]."js/functions.js", false, null, false);
wp_register_script("hwextpro-js", $hwextproInfo["dir-url"]."js/script.js", false, null, false);

?>