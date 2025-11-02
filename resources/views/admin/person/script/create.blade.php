<script defer>
(function() {
    // Generic fetch untuk mengisi select.
    // keyValue = e.g. "id_provinsi", keyText = e.g. "provinsi"
    function fetchDataDropdown(url, selector, keyValue, keyText, placeholderText = '-- Pilih --', callback) {
        const $sel = $(selector);
        $sel.empty().append(`<option value="">${placeholderText}</option>`);

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
        }).done(function(response) {
            if (response && response.success && Array.isArray(response.data)) {
                response.data.forEach(item => {
                    const val = item[keyValue] ?? item[keyValue.toLowerCase()] ?? '';
                    const text = item[keyText] ?? item[keyText.toLowerCase()] ?? '';
                    $sel.append(`<option value="${val}">${text}</option>`);
                });
            }
            // init/select2 safe
            if ($.fn.select2) {
                if (!$sel.hasClass('select2-hidden-accessible')) {
                    $sel.select2({ width: '100%', placeholder: placeholderText, allowClear: true });
                } else {
                    $sel.trigger('change.select2');
                }
            }

            if (typeof callback === 'function') callback();
        }).fail(function(xhr) {
            console.error('fetchDataDropdown error:', xhr.responseText || xhr.statusText);
            $sel.empty().append(`<option value="">Gagal memuat data</option>`);
        });
    }

    // bind handler sekali
    $('#form_create').off('show.bs.modal').on('show.bs.modal', function () {
        // jika elemen tanggal_lahir ada -> inisialisasi
        if ($('#tanggal_lahir').length && typeof flatpickr === 'function') {
            $('#tanggal_lahir').flatpickr({
                dateFormat: 'Y-m-d',
                altFormat: 'd/m/Y',
                allowInput: false,
                altInput: true,
            });
        }

        // isi provinsi saat modal dibuka
        fetchDataDropdown("{{ route('api.almt.provinsi') }}", "#id_provinsi", "id_provinsi", "provinsi", "Pilih Provinsi");

        // kosongkan downstream selects (default)
        $('#id_kabupaten').empty().append('<option value="">-- Pilih Kabupaten/Kota --</option>');
        $('#id_kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
        $('#id_desa').empty().append('<option value="">-- Pilih Desa/Kelurahan --</option>');
    });

    // change handlers: buat URL dan fetch *di dalam* handler (saat nilai ada)
    $('#id_provinsi').off('change').on('change', function () {
        const provinsiId = $(this).val();
        $('#id_kabupaten').empty().append('<option value="">-- Pilih Kabupaten/Kota --</option>');
        $('#id_kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
        $('#id_desa').empty().append('<option value="">-- Pilih Desa/Kelurahan --</option>');

        if (provinsiId) {
            const kabupatenUrl = `{{ route('api.almt.kabupaten', ':id') }}`.replace(':id', provinsiId);
            fetchDataDropdown(kabupatenUrl, '#id_kabupaten', 'id_kabupaten', 'kabupaten', 'Pilih Kabupaten/Kota');
        }
    });

    $('#id_kabupaten').off('change').on('change', function () {
        const kabupatenId = $(this).val();
        $('#id_kecamatan').empty().append('<option value="">-- Pilih Kecamatan --</option>');
        $('#id_desa').empty().append('<option value="">-- Pilih Desa/Kelurahan --</option>');

        if (kabupatenId) {
            const kecamatanUrl = `{{ route('api.almt.kecamatan', ':id') }}`.replace(':id', kabupatenId);
            fetchDataDropdown(kecamatanUrl, '#id_kecamatan', 'id_kecamatan', 'kecamatan', 'Pilih Kecamatan');
        }
    });

    $('#id_kecamatan').off('change').on('change', function () {
        const kecamatanId = $(this).val();
        $('#id_desa').empty().append('<option value="">-- Pilih Desa/Kelurahan --</option>');

        if (kecamatanId) {
            const desaUrl = `{{ route('api.almt.desa', ':id') }}`.replace(':id', kecamatanId);
            fetchDataDropdown(desaUrl, '#id_desa', 'id_desa', 'desa', 'Pilih Desa/Kelurahan');
        }
    });

    // submit handler tetap seperti biasa — pastikan id form sesuai
    $('#bt_submit_create').off('submit').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Kamu yakin?',
                text: 'Apakah datanya benar dan apa yang anda inginkan?',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false, allowEscapeKey: false,
                showCancelButton: true,
                cancelButtonColor: '#dd3333',
                confirmButtonText: 'Ya, Simpan', cancelButtonText: 'Batal', focusCancel: true,
            }).then((result) => {
                if (result.value) {
                    DataManager.openLoading();
                    const formData = new FormData();
                    formData.append('nama_lengkap', $('#nama_lengkap').val());
                    formData.append('nama_panggilan', $('#nama_panggilan').val());
                    formData.append('jk', $('#jk').val());
                    formData.append('tempat_lahir', $('#tempat_lahir').val());
                    formData.append('tanggal_lahir', $('#tanggal_lahir').val());
                    formData.append('kewarganegaraan', $('#kewarganegaraan').val());
                    formData.append('golongan_darah', $('#golongan_darah').val());
                    formData.append('nik', $('#nik').val());
                    formData.append('kk', $('#kk').val());
                    formData.append('alamat', $('#alamat').val());
                    formData.append('rt', $('#rt').val());
                    formData.append('rw', $('#rw').val());
                    formData.append('id_desa', $('#id_desa').val());
                    formData.append('npwp', $('#npwp').val());
                    formData.append('no_hp', $('#no_hp').val());
                    formData.append('email', $('#email').val());

                    const fileInput = $('#foto')[0];
                    if (fileInput.files[0]) {
                        formData.append('foto', fileInput.files[0]);
                    }

                    const action = "{{ route('admin.admin.person.store') }}";
                    DataManager.formData(action, formData).then(response => {
                        if (response.success) {
                            Swal.fire('Success', response.message, 'success');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                        if (!response.success && response.errors) {
                            const validationErrorFilter = new ValidationErrorFilter();
                            validationErrorFilter.filterValidationErrors(response);
                            Swal.fire('Warning', 'validasi bermasalah', 'warning');
                        }

                        if (!response.success && !response.errors) {
                            Swal.fire('Peringatan', response.message, 'warning');
                        }

                    }).catch(error => {
                        ErrorHandler.handleError(error);
                    });
                }
            })
        });

    // Bersihkan modal saat ditutup
    $('#form_create').off('hidden.bs.modal').on('hidden.bs.modal', function () {
        const $m = $(this);
        $m.find('form').trigger('reset');
        $m.find('select, textarea').val('').trigger('change');
        $m.find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
        $m.find('.invalid-feedback, .valid-feedback, .text-danger').remove();
    });

    // optional: tangkap error global untuk debugging
    window.addEventListener('error', function (evt) {
        console.error('Global error:', evt.message, 'at', evt.filename + ':' + evt.lineno);
    });
})();
</script>
