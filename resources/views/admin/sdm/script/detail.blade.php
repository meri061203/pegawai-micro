<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.sdm.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    $('#detail_nip').text(response.data.nip);
                    $('#detail_status_pegawai').text(response.data.status_pegawai === 'TETAP' ? 'TETAP' : (response.data.status_pegawai === 'KONTRAK' ? 'KONTRAK' : response.data.status_pegawai));
                    $('#detail_tipe_pegawai').text(response.data.tipe_pegawai === 'FULL TIME' ? 'FULL TIME' : (response.data.tipe_pegawai === 'PART TIME' ? 'PART TIME' : response.data.status_pegawai));
                    $('#detail_tanggal_masuk').text(formatter.formatDate(response.data.tanggal_masuk));
                    $('#detail_id_person').text(response.data.id_person);
                    $('#detail_created_at').text(response.data.created_at);
                    $('#detail_updated_at').text(response.data.updated_at);
                    // Handle foto display
                    if (response.data.foto) {
                        const photoUrl = '{{ route('admin.view-file', [':folder', ':filename']) }}'
                            .replace(':folder', 'person')
                            .replace(':filename', response.data.foto);
                        $('#detail_foto_preview').attr('src', photoUrl);
                    } else {
                        $('#detail_foto_preview').attr('src', '');
                    }
                } else {
                    Swal.fire('Peringatan', response.message, 'warning');
                }
            }).catch(function (error) {
            ErrorHandler.handleError(error);
        });
    });
</script>
