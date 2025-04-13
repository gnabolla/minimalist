<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Simple MVC'; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <?php if(isset($_SESSION['user'])): ?>
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="<?php echo BASE_URL; ?>" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">Simple MVC</span>
                    </a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="<?php echo BASE_URL; ?>" class="inline-flex items-center px-1 pt-1 text-gray-900">Home</a>
                        <?php if(isset($_SESSION['user']['is_admin']) && $_SESSION['user']['is_admin']): ?>
                        <a href="<?php echo BASE_URL; ?>admin" class="inline-flex items-center px-1 pt-1 text-gray-900">Admin Dashboard</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-700 mr-4"><?php echo $_SESSION['user']['name']; ?></span>
                    <a href="<?php echo BASE_URL; ?>auth/logout" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <?php endif; ?>