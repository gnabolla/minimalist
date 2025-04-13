<?php
$pageTitle = 'Edit User';
require_once 'views/layouts/header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Edit User</h2>
                <a href="<?php echo BASE_URL; ?>admin" class="text-blue-600 hover:text-blue-900">Back to List</a>
            </div>

            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo BASE_URL; ?>admin/edit?id=<?php echo $userData['id']; ?>" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($userData['name']); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($userData['email']); ?>"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password:</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Leave empty to keep current password</p>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="is_admin" name="is_admin" <?php echo $userData['is_admin'] ? 'checked' : ''; ?>
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="is_admin" class="ml-2 block text-sm text-gray-900">Is Admin?</label>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="<?php echo BASE_URL; ?>admin" 
                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>