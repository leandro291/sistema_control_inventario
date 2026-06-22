<?php
require_once '../includes/auth_check.php';
$page_title = 'Movimientos';
$current_page = 'movimientos';
require_once '../config/database.php';
$db = new Database();
$conn = $db->conn;

require_once '../functions/movimientos_db.php';
manejarAcciones($conn);

$movimientos = obtenerMovimientos($conn);
$productosList = obtenerListaProductos($conn);
$proveedoresList = obtenerListaProveedores($conn);

require '../includes/head.php';
require '../includes/sidebar.php';
?>

      <!-- ── MAIN CONTENT ── -->
      <main class="flex flex-col overflow-hidden">

        <!-- Top bar -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">Movimientos</h2>
            <p class="text-sm text-gray-400">Historial de entradas y salidas de inventario</p>
          </div>
        </header>

        <!-- Content area -->
        <div class="flex-1 overflow-y-auto p-8">

          <!-- Título sección -->
          <h2 class="text-base font-semibold text-gray-700 mb-3">Lista de Movimientos</h2>

          <!-- Barra superior: búsqueda + botón -->
          <div class="flex items-center gap-4 mb-6">
            <input
              id="search-input"
              type="text"
              placeholder="Buscar movimiento por tipo, proveedor o fecha..."
              class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
            />
            <button
              id="btn-exportar"
              class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition whitespace-nowrap flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
              </svg>
              Exportar Excel
            </button>
            <button
              onclick="document.getElementById('modal').style.display='flex'"
              class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition whitespace-nowrap">
              + Registrar movimiento
            </button>
          </div>

          <!-- Tabla de movimientos -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table id="tabla-movimientos" class="w-full text-sm">
              <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
                <tr>
                  <th class="px-5 py-3 text-left">ID</th>
                  <th class="px-5 py-3 text-left">Producto</th>
                  <th class="px-5 py-3 text-left">Cantidad</th>
                  <th class="px-5 py-3 text-left">Tipo</th>
                  <th class="px-5 py-3 text-left">Proveedor</th>
                  <th class="px-5 py-3 text-left">Fecha</th>
                  <th class="px-5 py-3 text-left">Motivo</th>
                </tr>
              </thead>
              <tbody id="tbody" class="divide-y divide-gray-100">
              </tbody>
            </table>

            <!-- Sin resultados -->
            <div id="sin-resultados" class="hidden py-16 text-center text-gray-400">
              <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
              <p class="text-sm">No se encontraron movimientos con ese criterio.</p>
            </div>

            <!-- Footer de tabla -->
            <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
              <span id="contador">Mostrando <strong class="text-gray-600">0</strong> movimientos</span>
              <span>Sistema de Control de Inventario</span>
            </div>
          </div>

        </div>
      </main>
    </div>

    <!-- ── MODAL REGISTRAR MOVIMIENTO ── -->
    <div id="modal" style="display:none" class="fixed inset-0 z-50 flex items-center justify-center">

      <!-- Backdrop con blur -->
      <div onclick="document.getElementById('modal').style.display='none'" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

      <!-- Contenido del modal -->
      <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-7 z-10">

        <!-- Header modal -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h3 class="text-lg font-bold text-gray-800">Registrar movimiento</h3>
            <p class="text-xs text-gray-400 mt-0.5">Completa los campos del formulario</p>
          </div>
          <button onclick="document.getElementById('modal').style.display='none'" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-1.5 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Formulario -->
        <form method="POST" action="movimientos.php" id="form-movimiento" class="space-y-4">
          <input type="hidden" name="action" value="registrar_movimiento" />

          <!-- Producto y Cantidad -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Producto</label>
              <select name="producto_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition bg-white">
                <option value="">Seleccionar...</option>
                <?php foreach ($productosList as $prod): ?>
                  <option value="<?= $prod['id'] ?>"><?= htmlspecialchars($prod['nombre']) ?> (Stock: <?= $prod['stock'] ?>)</option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Cantidad</label>
              <input name="cantidad" type="number" min="1" placeholder="Ej. 100" required
                class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
            </div>
          </div>

          <!-- Proveedor y Tipo -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Proveedor</label>
              <select name="proveedor_id" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition bg-white">
                <option value="">Seleccionar...</option>
                <?php foreach ($proveedoresList as $prov): ?>
                  <option value="<?= $prov['id'] ?>"><?= htmlspecialchars($prov['nombre']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label class="block text-xs font-medium text-gray-600 mb-1">Tipo</label>
              <select name="tipo" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition bg-white">
                <option value="">Seleccionar...</option>
                <option value="Entrada">Entrada</option>
                <option value="Salida">Salida</option>
              </select>
            </div>
          </div>

          <!-- Motivo -->
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Motivo</label>
            <input name="motivo" type="text" placeholder="Ej. Compra de stock" required
              class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>

          <!-- Botón registrar -->
          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-lg transition mt-2">
            Registrar movimiento
          </button>

        </form>
      </div>
    </div>

    <script>
      const movimientos = <?php echo json_encode($movimientos); ?>;
    </script>
    <script src="../js/movimientos/tabla.js"></script>
    <script src="../js/movimientos/busqueda.js"></script>

    <!-- SheetJS (xlsx) -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="../js/movimientos/exportar.js"></script>
  </body>
</html>
