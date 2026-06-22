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
    <title>Registro - Control de Inventario</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <div class="mx-auto w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Crea tu cuenta</h1>
            <p class="text-gray-400 text-sm mt-1">Regístrate para gestionar el inventario</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-50 text-red-600 text-sm p-3 rounded-lg mb-6 border border-red-100">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="functions/auth_db.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="registro">
            
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Nombre de Usuario</label>
                <input type="text" name="nombre" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Contraseña</label>
                <input type="password" name="password" required minlength="6" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition mt-4 shadow-md shadow-blue-500/30">
                Registrarse
            </button>
        </form>
        
        <p class="text-center text-sm text-gray-500 mt-6">
            ¿Ya tienes cuenta? <a href="login.php" class="text-blue-600 hover:underline font-medium">Inicia sesión</a>
        </p>
    </div>
</body>
</html>
