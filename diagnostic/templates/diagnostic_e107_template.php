<?php
echo "<table class='table table-bordered'><thead><tr>
<th>Plugin</th><th>Estado</th><th>Registrado</th><th>Clase</th><th>Shortcodes</th><th>Eventos</th>
</tr></thead><tbody>";

foreach ($results as $plugin => $data) {
    echo "<tr>
        <td>{$plugin}</td>
        <td>".($data['active'] ? '🟢 Activo' : '⚪ Inactivo')."</td>
        <td>".($data['registered'] ? '✅' : '❌')."</td>
        <td>{$data['class']}</td>
        <td>".implode(', ', $data['shortcodes'])."</td>
        <td>".implode(', ', $data['events'])."</td>
    </tr>";
}

echo "</tbody></table>";

