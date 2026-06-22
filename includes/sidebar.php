<?php
$base_url = isset($is_root) ? '.' : '..';
$pages_url = isset($is_root) ? 'pages' : '.';
?>
      <!-- ── SIDEBAR ── -->
      <aside class="bg-gray-900 text-white flex flex-col">
        <!-- Logo -->
        <div class="px-6 py-5 border-b border-gray-700 flex items-center gap-2">
          <h1 class="text-xl font-bold tracking-wide text-white">Nate Inventory</h1>
        </div>

        <!-- Nav links -->
        <nav class="flex-1 px-4 py-6 space-y-1">
          <a href="<?php echo $base_url; ?>/index.php" class="<?php echo (isset($current_page) && $current_page == 'inicio') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg> Inicio
          </a>
          <a href="<?php echo $pages_url; ?>/productos.php" class="<?php echo (isset($current_page) && $current_page == 'productos') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg> Productos
          </a>
          <a href="<?php echo $pages_url; ?>/proveedores.php" class="<?php echo (isset($current_page) && $current_page == 'proveedores') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg> Proveedores
          </a>
          <a href="<?php echo $pages_url; ?>/movimientos.php" class="<?php echo (isset($current_page) && $current_page == 'movimientos') ? 'flex items-center gap-3 px-4 py-2.5 rounded-lg bg-blue-600 text-white font-medium transition' : 'flex items-center gap-3 px-4 py-2.5 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition'; ?>">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg> Movimientos
          </a>
        </nav>

        <!-- User footer -->
        <div class="p-5 border-t border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
            <?php echo isset($_SESSION['usuario_nombre']) ? strtoupper(substr($_SESSION['usuario_nombre'], 0, 1)) : 'U'; ?>
          </div>
          <div>
            <p class="text-sm font-medium text-gray-700"><?php echo isset($_SESSION['usuario_nombre']) ? htmlspecialchars($_SESSION['usuario_nombre']) : 'Usuario'; ?></p>
            <p class="text-xs text-gray-400">Administrador</p>
          </div>
        </div>
        <a href="<?php echo isset($is_root) && $is_root ? 'logout.php' : '../logout.php'; ?>" class="text-gray-400 hover:text-red-500 transition" title="Cerrar Sesión">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
        </a>
      </div>
    </aside>
