<?php

// Load the autoloader
require_once __DIR__ . '/autoload.inc.php';

// Define default configuration
define("DOMPDF_DIR", __DIR__);
define("DOMPDF_TEMP_DIR", sys_get_temp_dir());
define("DOMPDF_FONT_DIR", DOMPDF_DIR . '/lib/fonts/');
define("DOMPDF_FONT_CACHE", DOMPDF_TEMP_DIR);
define("DOMPDF_CHROOT", realpath(DOMPDF_DIR));
define("DOMPDF_LOG_OUTPUT_FILE", DOMPDF_DIR . "/log/dompdf.log");
define("DOMPDF_DEFAULT_MEDIA_TYPE", "screen");
define("DOMPDF_DEFAULT_PAPER_SIZE", "A4");
define("DOMPDF_DEFAULT_FONT", "serif");
define("DOMPDF_DPI", 96);
define("DOMPDF_ENABLE_PHP", false);
define("DOMPDF_ENABLE_REMOTE", true);
define("DOMPDF_ENABLE_CSS_FLOAT", true);
define("DOMPDF_ENABLE_HTML5PARSER", true);
define("DOMPDF_FONT_HEIGHT_RATIO", 1.1);
define("DEBUGPNG", false);
define("DEBUGKEEPTEMP", false);
define("DEBUGCSS", false);
define("DEBUG_LAYOUT", false);
define("DEBUG_LAYOUT_LINES", true);
define("DEBUG_LAYOUT_BLOCKS", true);
define("DEBUG_LAYOUT_INLINE", true);
define("DOMPDF_ADMIN_USERNAME", "admin");
define("DOMPDF_ADMIN_PASSWORD", "password");
