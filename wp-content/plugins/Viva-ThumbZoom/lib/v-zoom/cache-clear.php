<?php
function SureRemoveDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }
    closedir($dh);
echo "Cache Cleared";
    if ($DeleteMe){
        @rmdir($dir);
    }
}
$d="../../../../uploads/cache";
SureRemoveDir($d,false);
?>
