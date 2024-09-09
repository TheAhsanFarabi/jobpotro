
<!-- Pagination Links -->
<div class="mt-6">
    <nav class="flex justify-center">
        <ul class="inline-flex items-center">
            <!-- Previous Page Link -->
            <?php if ($page > 1): ?>
            <li>
                <a href="?page=<?php echo $page - 1; ?>"
                    class="px-3 py-2 mx-1 bg-blue-500 text-white rounded hover:bg-blue-600">&laquo; Previous</a>
            </li>
            <?php endif; ?>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li>
                <a href="?page=<?php echo $i; ?>"
                    class="px-3 py-2 mx-1 <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-white text-blue-500 hover:bg-blue-500 hover:text-white'; ?> rounded">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php endfor; ?>

            <!-- Next Page Link -->
            <?php if ($page < $total_pages): ?>
            <li>
                <a href="?page=<?php echo $page + 1; ?>"
                    class="px-3 py-2 mx-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next &raquo;</a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
