<?php

#=================================================================
# CSS File Attachments
#=================================================================

/* ------------------- Bootstrap ------------------ */
wp_register_style('hwct-bootstrap', $hwctInfo["dir-url"]."lib/bootstrap/css/bootstrap.min.css", false,'3.0');
wp_register_style('hwct-bootstrap-theme', $hwctInfo["dir-url"]."lib/bootstrap/css/bootstrap-theme.min.css", false,'3.0');

/* ------------------- Theme Style ------------------ */
wp_register_style('hwct-style', $hwctInfo["dir-url"]."css/style.css", false,null);


#=================================================================
# JS File Attachments
#=================================================================

/* ------------------- Bootstrap ------------------ */
wp_register_script("hwct-bootstrap", $hwctInfo["dir-url"]."lib/bootstrap/js/bootstrap.min.js", false, '3.0', false);

/* ------------------- Datatables Plugin  ------------------ */
wp_register_script("dataTable-js", $hwctInfo["dir-url"]."lib/datatables/jquery.dataTables.min.js", false, null, false);
wp_register_script("datatable-sort-js", $hwctInfo["dir-url"]."lib/datatables/jquery.dataTables.sorting.js", false, null, false);

/* ------------------- Stream Table Plugin  ------------------ */
wp_register_script("hwct-streamtable-js", $hwctInfo["dir-url"]."lib/streamtable/stream-table.js", false, null, false);
wp_register_script("hwct-stream-mustache-js", $hwctInfo["dir-url"]."lib/streamtable/mustache.js", false, null, false);
wp_register_script("hwct-stream-sort-js", $hwctInfo["dir-url"]."lib/streamtable/stream-sorting.js", false, null, false);

/* ------------------- Theme Js ------------------ */
wp_register_script("hwct-js-functions", $hwctInfo["dir-url"]."js/functions.js", false, null, false);
wp_register_script("hwct-js", $hwctInfo["dir-url"]."js/script.js", false, null, false);
?>