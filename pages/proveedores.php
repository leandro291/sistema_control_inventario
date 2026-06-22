<?php
$page_title = 'Proveedores';
$current_page = 'proveedores';
require_once '../config/database.php';

$db = new Database();
$conn = $db->conn;

require_once '../functions/proveedores_db.php';

// Manejamos las peticiones POST (registro)
manejarAcciones($conn);

$proveedores = obtenerProveedores($conn);

require '../includes/head.php';
require '../includes/sidebar.php';
?>

    <!-- ── MAIN CONTENT ── -->
    <main class="flex flex-col overflow-hidden">

      <!-- Top bar -->
      <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
        <div>
          <h2 class="text-lg font-semibold text-gray-800">Proveedores</h2>
          <p class="text-sm text-gray-400">Gestión y visualización de proveedores</p>
        </div>
      </header>

      <!-- Content area -->
      <div class="flex-1 overflow-y-auto p-8">

        <!-- Título sección -->
        <h2 class="text-base font-semibold text-gray-700 mb-3">Lista de Proveedores</h2>

        <!-- Barra superior: búsqueda + botón -->
        <div class="flex items-center gap-4 mb-6">
          <input
            id="search-input"
            type="text"
            placeholder="Buscar proveedor por nombre, RUC o correo..."
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition"
          />
          <button
            onclick="document.getElementById('modal').style.display='flex'"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition whitespace-nowrap">
            + Registrar nuevo proveedor
          </button>
        </div>

        <!-- Tabla de proveedores -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
          <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-100">
              <tr>
                <th class="px-5 py-3 text-left">ID</th>
                <th class="px-5 py-3 text-left">RUC</th>
                <th class="px-5 py-3 text-left">Nombre</th>
                <th class="px-5 py-3 text-left">Correo</th>
                <th class="px-5 py-3 text-center">Acciones</th>
              </tr>
            </thead>
            <tbody id="tbody" class="divide-y divide-gray-100">
            </tbody>
          </table>

          <!-- Sin resultados -->
          <div id="sin-resultados" class="hidden py-16 text-center text-gray-400">
            <p class="text-4xl mb-3">🔍</p>
            <p class="text-sm">No se encontraron proveedores con ese criterio.</p>
          </div>

          <!-- Footer de tabla -->
          <div class="px-5 py-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
            <span id="contador">Mostrando <strong class="text-gray-600">0</strong> proveedores</span>
            <span>Sistema de Control de Inventario</span>
          </div>
        </div>

      </div>
    </main>

    <!-- ── MODAL REGISTRAR PROVEEDOR ── -->
    <div id="modal" style="display:none" class="fixed inset-0 z-50 flex items-center justify-center">

      <!-- Backdrop con blur -->
      <div onclick="document.getElementById('modal').style.display='none'" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

      <!-- Contenido del modal -->
      <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-7 z-10">

        <!-- Header modal -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <h3 class="text-lg font-bold text-gray-800">Registrar nuevo proveedor</h3>
            <p class="text-xs text-gray-400 mt-0.5">Completa los campos del formulario</p>
          </div>
          <button onclick="document.getElementById('modal').style.display='none'" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-1.5 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Formulario -->
        <form method="POST" action="proveedores.php" id="form-proveedor" class="space-y-4">
          <input type="hidden" name="action" value="registrar_proveedor" />

          <!-- RUC -->
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">RUC</label>
            <input name="ruc" type="text" placeholder="Ej. 20123456789" required
              class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>

          <!-- Nombre -->
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Nombre del proveedor</label>
            <input name="nombre" type="text" placeholder="Ej. DistMax S.A." required
              class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>

          <!-- Correo -->
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Correo electrónico</label>
            <input name="correo" type="email" placeholder="Ej. contacto@distmax.com" required
              class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>

          <!-- Botón registrar -->
          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-lg transition mt-2">
            Registrar proveedor
          </button>

        </form>
      </div>
    </div>

    <!-- ── MODAL EDITAR PROVEEDOR ── -->
    <div id="modal-editar" style="display:none" class="fixed inset-0 z-50 flex items-center justify-center">
      <div onclick="document.getElementById('modal-editar').style.display='none'" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
      <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-7 z-10">
        <div class="flex items-center justify-between mb-6">
          <div>
            <h3 class="text-lg font-bold text-gray-800">Editar proveedor</h3>
            <p class="text-xs text-gray-400 mt-0.5">Modifica los campos necesarios</p>
          </div>
          <button onclick="document.getElementById('modal-editar').style.display='none'" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-1.5 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <form method="POST" action="proveedores.php" id="form-editar-proveedor" class="space-y-4">
          <input type="hidden" name="action" value="editar_proveedor" />
          <input type="hidden" name="id_proveedor" id="edit_id_proveedor" />

          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">RUC</label>
            <input name="ruc" id="edit_ruc" type="text" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Nombre del proveedor</label>
            <input name="nombre" id="edit_nombre" type="text" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Correo electrónico</label>
            <input name="correo" id="edit_correo" type="email" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" />
          </div>

          <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm py-2.5 rounded-lg transition mt-2">
            Guardar cambios
          </button>
        </form>
      </div>
    </div>

    <!-- ── FORMULARIO ELIMINAR OCULTO ── -->
    <form method="POST" action="proveedores.php" id="form-eliminar-proveedor" style="display:none;">
      <input type="hidden" name="action" value="eliminar_proveedor" />
      <input type="hidden" name="id_proveedor" id="delete_id_proveedor" />
    </form>

    <script>
      const proveedores = <?php echo json_encode($proveedores); ?>;
    </script>
    <script src="../js/proveedores/tabla.js"></script>
    <script src="../js/proveedores/busqueda.js"></script>
  </body>
</html>
