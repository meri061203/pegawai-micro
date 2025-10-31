<script defer>
    $('#form_detail').on('show.bs.modal', function (e) {
        $(this).attr('aria-hidden', 'false');
        const button = $(e.relatedTarget);
        const id = button.data("id");
        const detail = '{{ route('admin.keluarga.show', [':id']) }}';
        DataManager.fetchData(detail.replace(':id', id))
            .then(function (response) {
                if (response.success) {
                    $('#detail_id_sdm').text(response.data.id_sdm);
                    $('#detail_id_person').text(response.data.id_person);
                    $('#detail_status').text(response.data.status === 'Kepala Keluarga' ? 'Kepala Keluarga' : (response.data.status === 'Istri' ? 'Istri' : ) : (response.data.status === 'Anak' ? 'Anak' : response.data.status));
                    $('#detail_status_tanggungan').text(response.data.status_tanggungan === 'Y' ? 'YA' : (response.data.status_tanggungan === 'T' ? 'TIDAK' : response.data.status_tanggungan));

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
