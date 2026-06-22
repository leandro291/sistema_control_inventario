<?php
$base_url = isset($is_root) ? '.' : '..';
$pages_url = isset($is_root) ? 'pages' : '.';
?>
      <!-- ── SIDEBAR ── -->
      <aside class="bg-gray-900 text-white flex flex-col">
        <!-- Logo -->
        <div class="px-6 py-5 border-b border-gray-700">
          <h1 class="text-xl font-bold tracking-wide text-white">⚡ MyDashboard</h1>
        </div>

        <!-- Nav links -->
        <nav class="flex-1 px-4 py-6 space-y-1">
          <a href="<?php echo $base_url; ?>/index.php" class="<?php echo (isset($current_page) && $current_page == 'inicio') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <span>🏠</span> Inicio
          </a>
          <a href="<?php echo $pages_url; ?>/productos.php" class="<?php echo (isset($current_page) && $current_page == 'productos') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <span>📦</span> Productos
          </a>
          <a href="<?php echo $pages_url; ?>/proveedores.php" class="<?php echo (isset($current_page) && $current_page == 'proveedores') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <span>🏭</span> Proveedores
          </a>
          <a href="<?php echo $pages_url; ?>/movimientos.php" class="<?php echo (isset($current_page) && $current_page == 'movimientos') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <span>🔄</span> Movimientos
          </a>
        </nav>

        <!-- User footer -->
        <div class="px-6 py-4 border-t border-gray-700 flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-blue-500 flex items-center justify-center font-bold text-sm">JD</div>
          <div>
            <p class="text-sm font-medium text-white">Juan Doe</p>
            <p class="text-xs text-gray-400">Admin</p>
          </div>
        </div>
      </aside>
