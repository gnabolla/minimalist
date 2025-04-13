<?php
$pageTitle = 'Error ' . $code;
require_once 'views/layouts/header.php';
?>

<div class="flex items-center justify-center min-h-[60vh] p-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8 text-center">
        <h2 class="text-4xl font-bold mb-4 text-gray-800"><?php echo $code; ?></h2>
        <p class="text-xl text-gray-600 mb-6"><?php echo $message; ?></p>
        <a href="<?php echo BASE_URL; ?>" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
            Go Home
        </a>
    </div>
</div>