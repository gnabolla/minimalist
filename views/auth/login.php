<?php 
$pageTitle = 'Login';
require_once 'views/layouts/header.php';
?>

<div class="flex items-center justify-center p-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo BASE_URL; ?>auth/login" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Login
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm">
            Don't have an account? 
            <a href="<?php echo BASE_URL; ?>auth/register" class="text-blue-600 hover:text-blue-800">Register</a>
        </div>
    </div>
</div>