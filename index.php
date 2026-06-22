<?php
require_once 'includes/auth_check.php';
$page_title = 'Dashboard';
$current_page = 'inicio';
$is_root = true;
require_once 'config/database.php';
$db = new Database();
$conn = $db->conn;

require_once 'functions/dashboard_db.php';
$stats = getDashboardStats($conn);
$actividad = getActividadReciente($conn);
$stockBajo = getProductosStockBajo($conn);
$chartMovimientos = getMovimientosUltimos7Dias($conn);
$chartTopStock = getTopProductosStock($conn);

require 'includes/head.php';
require 'includes/sidebar.php';
?>

      <!-- ── MAIN CONTENT ── -->
      <main class="flex flex-col overflow-hidden">

        <!-- Top bar -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
          <div>
            <h2 id="page-title" class="text-lg font-semibold text-gray-800">Inicio</h2>
            <p id="page-subtitle" class="text-sm text-gray-400">Resumen general del sistema</p>
          </div>
        </header>

        <!-- Content area -->
        <div class="flex-1 overflow-y-auto p-8">

          <!-- ===== INICIO ===== -->
          <section id="section-inicio">
            <div class="grid grid-cols-4 gap-5 mb-8">
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Total Productos</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['total_productos']; ?></p>
              </div>
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Proveedores</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['total_proveedores']; ?></p>
              </div>
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Entradas hoy</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['entradas_hoy']; ?></p>
              </div>
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Salidas hoy</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['salidas_hoy']; ?></p>
              </div>
            </div>

            <!-- Gráficos -->
            <div class="grid grid-cols-2 gap-5 mb-8">
              <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-4">Movimientos (Últimos 7 días)</h3>
                <div class="relative h-64">
                  <canvas id="chartMovimientos"></canvas>
                </div>
              </div>
              <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-4">Top 5 Productos con mayor stock</h3>
                <div class="relative h-64 flex justify-center">
                  <canvas id="chartStock"></canvas>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-5">
              <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-4">Actividad reciente</h3>
                <ul class="space-y-3">
                  <?php if (empty($actividad)): ?>
                    <li class="text-sm text-gray-500">No hay actividad reciente.</li>
                  <?php else: ?>
                    <?php foreach ($actividad as $act): ?>
                      <?php 
                        if ($act['tipo'] == 'INGRESO') {
                            $color = 'bg-blue-500';
                            $texto = 'Entrada de ' . $act['cantidad'] . ' unidades — ' . htmlspecialchars($act['producto']);
                        } else {
                            $color = 'bg-red-500';
                            $texto = 'Salida de ' . $act['cantidad'] . ' unidades — ' . htmlspecialchars($act['producto']);
                        }
                      ?>
                      <li class="flex items-center gap-3 text-sm text-gray-600">
                        <span class="w-2 h-2 rounded-full <?php echo $color; ?>"></span>
                        <?php echo $texto; ?>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>
              <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-4">Productos con stock bajo (≤ 10)</h3>
                <ul class="space-y-3">
                  <?php if (empty($stockBajo)): ?>
                    <li class="text-sm text-gray-500">No hay productos con stock bajo.</li>
                  <?php else: ?>
                    <?php foreach ($stockBajo as $prod): ?>
                      <?php
                        $badgeClass = ($prod['stock'] <= 3) ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600';
                      ?>
                      <li class="flex justify-between items-center text-sm">
                        <span class="text-gray-600"><?php echo htmlspecialchars($prod['nombre']); ?></span>
                        <span class="<?php echo $badgeClass; ?> text-xs px-2 py-0.5 rounded-full"><?php echo $prod['stock']; ?> uds</span>
                      </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      // Datos desde PHP (globales para que charts.js los consuma)
      const movLabels = <?php echo json_encode($chartMovimientos['labels']); ?>;
      const movIngresos = <?php echo json_encode($chartMovimientos['ingresos']); ?>;
      const movSalidas = <?php echo json_encode($chartMovimientos['salidas']); ?>;

      const topStockLabels = <?php echo json_encode($chartTopStock['labels']); ?>;
      const topStockData = <?php echo json_encode($chartTopStock['data']); ?>;
    </script>
    <script src="js/dashboard/charts.js"></script>
  </body>
</html>
