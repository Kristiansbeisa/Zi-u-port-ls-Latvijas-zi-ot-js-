<?php
function log_activity($lietotajs, $darbiba, $details='') {
    $line = "[".date('Y-m-d H:i:s')."] Lietotājs: $lietotajs | Darbība: $darbiba | $details\n";
    file_put_contents('logs.txt', $line, FILE_APPEND);
}
?>