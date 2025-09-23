<?php
error_log("✅ diagnostic_ui.php cargado");

class diagnostic_ui extends e_admin_ui
{
    public function render()
    {
        error_log("✅ método render ejecutado");

        echo "<!DOCTYPE html><html><head><title>Diagnóstico</title></head><body>";
        echo "<div style='padding:20px; font-size:18px; color:green;'>✅ Diagnóstico cargado correctamente</div>";
        echo "</body></html>";
        exit;
    }
}
