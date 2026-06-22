<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Control de Inventario</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <div class="mx-auto w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Bienvenido de nuevo</h1>
            <p class="text-gray-400 text-sm mt-1">Ingresa a tu cuenta para continuar</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-50 text-red-600 text-sm p-3 rounded-lg mb-6 border border-red-100">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="functions/auth_db.php" method="POST" class="space-y-5">
            <input type="hidden" name="action" value="login">
            
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Nombre de Usuario</label>
                <input type="text" name="nombre" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Contraseña</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition mt-2 shadow-md shadow-blue-500/30">
                Iniciar Sesión
            </button>
        </form>
        
        <p class="text-center text-sm text-gray-500 mt-6">
            ¿No tienes cuenta? <a href="registro.php" class="text-blue-600 hover:underline font-medium">Regístrate aquí</a>
        </p>
    </div>
</body>
</html>
