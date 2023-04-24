<script>
    @if (session('message'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: '{{ session('icon') }}',
            title: '{{ session('message') }}',
        })
    @endif
    function flashToast(icon, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
        })
        Toast.fire({
            icon: icon,
            title: message,
        })
    }
</script>
