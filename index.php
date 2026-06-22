<?php
$page_title = 'Dashboard';
$current_page = 'inicio';
$is_root = true;
require_once 'config/database.php';

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
          <div class="flex items-center gap-3">
            <button class="relative p-2 rounded-lg hover:bg-gray-100 transition">
              🔔
              <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <button id="btn-nuevo" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition">
              + Nuevo
            </button>
          </div>
        </header>

        <!-- Content area -->
        <div class="flex-1 overflow-y-auto p-8">

          <!-- ===== INICIO ===== -->
          <section id="section-inicio">
            <div class="grid grid-cols-4 gap-5 mb-8">
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Total Productos</p>
                <p class="text-2xl font-bold text-gray-800">340</p>
                <p class="text-xs text-green-500 mt-1">↑ 8% este mes</p>
              </div>
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Proveedores</p>
                <p class="text-2xl font-bold text-gray-800">24</p>
                <p class="text-xs text-green-500 mt-1">↑ 2 nuevos</p>
              </div>
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Entradas hoy</p>
                <p class="text-2xl font-bold text-gray-800">58</p>
                <p class="text-xs text-green-500 mt-1">↑ 12% vs ayer</p>
              </div>
              <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 mb-1">Salidas hoy</p>
                <p class="text-2xl font-bold text-gray-800">31</p>
                <p class="text-xs text-red-400 mt-1">↓ 5% vs ayer</p>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-5">
              <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-4">Actividad reciente</h3>
                <ul class="space-y-3">
                  <li class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Entrada de 50 unidades — Producto A
                  </li>
                  <li class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    Nuevo proveedor registrado — DistMax
                  </li>
                  <li class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                    Stock bajo — Producto C (3 unidades)
                  </li>
                  <li class="flex items-center gap-3 text-sm text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Salida de 20 unidades — Producto B
                  </li>
                </ul>
              </div>
              <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-4">Productos con stock bajo</h3>
                <ul class="space-y-3">
                  <li class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Producto C</span>
                    <span class="bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">3 uds</span>
                  </li>
                  <li class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Producto F</span>
                    <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-0.5 rounded-full">7 uds</span>
                  </li>
                  <li class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Producto K</span>
                    <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-0.5 rounded-full">9 uds</span>
                  </li>
                  <li class="flex justify-between items-center text-sm">
                    <span class="text-gray-600">Producto M</span>
                    <span class="bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full">1 ud</span>
                  </li>
                </ul>
              </div>
            </div>
          </section>

        </div>
      </main>
    </div>
  </body>
</html>
