<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="MCMastery">
    <meta name="author" content="MCMastery">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Admin Panel - MCMastery</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    <style>
        .profile-image {
            width: 80px;
            /* Lebar tetap */
            height: 80px;
            /* Tinggi tetap */
            object-fit: cover;
            /* Memastikan gambar tidak terdistorsi */
            border-radius: 50%;
            /* Membuat gambar berbentuk lingkaran */
            overflow: hidden;
            /* Menghindari tampilan overflow */
            display: block;
            /* Menyusun gambar sebagai block element */
        }

        .profile-image-small {
            width: 40px;
            /* Ukuran yang cocok untuk navbar */
            height: 40px;
            /* Ukuran yang cocok untuk navbar */
            object-fit: cover;
            /* Memastikan gambar tidak terdistorsi */
            border-radius: 50%;
            /* Membuat gambar berbentuk lingkaran */
            overflow: hidden;
            /* Menghindari tampilan overflow */
        }

        .photo_image {
            width: 150px;
            /* Ukuran gambar (Anda bisa menyesuaikan) */
            height: 150px;
            /* Pastikan tinggi dan lebar sama untuk membuat lingkaran */
            border-radius: 50%;
            /* Membuat gambar menjadi lingkaran */
            object-fit: cover;
            /* Menjaga rasio aspek dan fokus ke tengah */
            border: 2px solid transparent;
            /* Opsional: Tambahkan border untuk estetika */
        }
    </style>
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.body.sidebar')
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('admin.body.header')
            <!-- partial -->
            @yield('admin')
            <!-- partial:partials/_footer.html -->
            @include('admin.body.footer')
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard-dark.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <!-- End custom js for this page -->
    @yield('script')
    <script type="text/javascript">
        function showModal(userId, type) {
            // Simpan ID pengguna dan tipe (role atau status) yang diubah
            document.getElementById('modalUserId').value = userId;
            document.getElementById('modalType').value = type;

            // Tampilkan modal konfirmasi
            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();
        }

        function submitForm() {
            var userId = document.getElementById('modalUserId').value;
            var type = document.getElementById('modalType').value;

            // Submit form yang sesuai berdasarkan tipe (role atau status)
            if (type === 'role') {
                document.getElementById('updateRoleForm' + userId).submit();
            } else if (type === 'status') {
                document.getElementById('updateStatusForm' + userId).submit();
            }
        }
    </script>
</body>

</html>
