// ── busqueda.js ──
// Filtrado en tiempo real de la tabla de productos

const input         = document.getElementById('search-input');
const filas         = document.querySelectorAll('#tbody tr');
const sinResultados = document.getElementById('sin-resultados');
const contador      = document.getElementById('contador');

input.addEventListener('input', () => {
  const query = input.value.toLowerCase().trim();
  let visibles = 0;

  filas.forEach(fila => {
    const texto    = fila.textContent.toLowerCase();
    const coincide = texto.includes(query);
    fila.classList.toggle('hidden', !coincide);
    if (coincide) visibles++;
  });

  sinResultados.classList.toggle('hidden', visibles > 0);
  contador.innerHTML = `Mostrando <strong class="text-gray-600">${visibles}</strong> producto${visibles !== 1 ? 's' : ''}`;
});
