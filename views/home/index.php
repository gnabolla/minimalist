<?php 
$pageTitle = 'Welcome';
require_once 'views/layouts/header.php';
?>

<div class="max-w-2xl mx-auto p-6 mt-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Welcome to Simple MVC</h1>
        <?php if (isset($data)): ?>
            <div class="space-y-4">
                <p class="text-lg"><span class="font-semibold">User:</span> <?php echo $data['name']; ?></p>
                <p class="text-lg"><span class="font-semibold">Email:</span> <?php echo $data['email']; ?></p>
                <p class="text-lg"><span class="font-semibold">Role:</span> <?php echo isset($data['is_admin']) && $data['is_admin'] ? 'Admin' : 'User'; ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
