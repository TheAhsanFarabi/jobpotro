<?php
mysqli_close($conn);
?>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#659BE1',
                }
            }
        }
    };
</script>
<?php include('components/toasts.php') ?>
<?php include('components/login.php') ?>
<?php include('components/register.php') ?>
<!-- <footer class="bg-gray-800 text-white w-full bottom-0 mt-10">
    <div class="container mx-auto text-center p-3">
        <span>&copy; Jobpotro 2024</span>
    </div>
</footer> -->



</body>

</html>