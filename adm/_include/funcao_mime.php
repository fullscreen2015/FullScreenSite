<?php
if (!function_exists('mime_content_type ')) {
    function mime_content_type($filename) {
        $finfo    = finfo_open(FILEINFO_MIME);
        $mimetype = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mimetype;
    }
}
?> 