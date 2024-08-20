 <!-- Toast Notification for Registration -->
 <div id="toast" class="fixed bottom-4 right-4 bg-green-500 text-white px-5 py-2 rounded shadow-lg hidden">
     Registration successful!
 </div>

 <!-- Toast Notification for Login -->
 <div id="toastLogin" class="fixed bottom-4 right-4 bg-blue-500 text-white px-5 py-2 rounded shadow-lg hidden">
     Logged in successfully!
 </div>

 <!-- Toast Notification for Logout -->
 <div id="toastLogout" class="fixed bottom-4 right-4 bg-yellow-600 text-white px-5 py-2 rounded shadow-lg hidden">
     You have been logged out!
 </div>

 <!-- Toast Notification for Error-->
 <div id="toastError" class="fixed bottom-4 right-4 bg-red-500 text-white px-5 py-2 rounded shadow-lg hidden">
     Invalid credentials!
 </div>

 <!-- Toast Notification for Error Duplicate-->
 <div id="toastErrorDuplicate" class="fixed bottom-4 right-4 bg-red-500 text-white px-5 py-2 rounded shadow-lg hidden">
     User already exist!
 </div>


 <script>
        document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        const error = urlParams.get('error');
        const logout = urlParams.get('logout');
        const login = urlParams.get('login');

        if (success === 'true') {
            const toast = document.getElementById('toast');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2000);
        }

        if (login === 'true') {
            const toast = document.getElementById('toastLogin');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2000);
        }

        if (logout === 'true') {
            const toast = document.getElementById('toastLogout');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2000);
        }

        if (error === 'true') {
            const toast = document.getElementById('toastError');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2000);
        }

        if (error === 'duplicate') {
            const toast = document.getElementById('toastErrorDuplicate');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 2000);
        }
    });
 </script>