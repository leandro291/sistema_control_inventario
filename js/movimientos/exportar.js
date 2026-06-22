// ── exportar.js ──
// Lógica para exportar la tabla de movimientos a Excel usando SheetJS

document.getElementById('btn-exportar').addEventListener('click', function() {
  // Seleccionar la tabla
  const tabla = document.getElementById('tabla-movimientos');
  
  // Crear un workbook a partir de la tabla HTML
  const wb = XLSX.utils.table_to_book(tabla, { sheet: "Movimientos" });
  
  // Descargar el archivo
  XLSX.writeFile(wb, "Reporte_Movimientos.xlsx");
});
