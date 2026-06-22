// ── charts.js ──
// Configuración y renderizado de los gráficos del Dashboard (Inicio)

// Gráfico de Movimientos (Barras)
const ctxMov = document.getElementById('chartMovimientos').getContext('2d');
new Chart(ctxMov, {
  type: 'bar',
  data: {
    labels: movLabels,
    datasets: [
      {
        label: 'Entradas',
        data: movIngresos,
        backgroundColor: 'rgba(59, 130, 246, 0.8)', // blue-500
        borderRadius: 4
      },
      {
        label: 'Salidas',
        data: movSalidas,
        backgroundColor: 'rgba(239, 68, 68, 0.8)', // red-500
        borderRadius: 4
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { position: 'bottom' }
    },
    scales: {
      y: { beginAtZero: true, ticks: { precision: 0 } }
    }
  }
});

// Gráfico Top Stock (Doughnut)
const ctxStock = document.getElementById('chartStock').getContext('2d');
new Chart(ctxStock, {
  type: 'doughnut',
  data: {
    labels: topStockLabels,
    datasets: [{
      data: topStockData,
      backgroundColor: [
        'rgba(59, 130, 246, 0.8)', // blue-500
        'rgba(16, 185, 129, 0.8)', // emerald-500
        'rgba(245, 158, 11, 0.8)', // amber-500
        'rgba(139, 92, 246, 0.8)', // violet-500
        'rgba(236, 72, 153, 0.8)'  // pink-500
      ],
      borderWidth: 0
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { position: 'right' }
    },
    cutout: '65%'
  }
});
