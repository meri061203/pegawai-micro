<div class="modal fade" id="form_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form method="post" id="bt_submit_create" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Person</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom 1: Foto -->

                        <!-- Kolom 2: Data Dasar -->
                        <div class="col-md-4">
                            <h6 class="text-primary fw-bold mb-3 border-bottom border-primary pb-2">Data Dasar</h6>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>nip</span>
                                </label>
                                <input type="text" id="nip" class="form-control form-control-sm fs-sm-8 fs-lg-6"
                                       maxlength="16" required/>
                                <div class="invalid-feedback"></div>
                            </div>

                             <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Status Pegawai</span>
                                </label>
                                <select data-control="select2" id="status_pegawai"
                                        class="form-control form-control-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih Status Pegawai" required>
                                    <option value="">Pilih Status Pegawai</option>
                                    <option value="T">TETAP</option>
                                    <option value="K">KONTRAK</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                             <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Tipe Pegawai</span>
                                </label>
                                <select data-control="select2" id="tipe_pegawai"
                                        class="form-control form-control-sm fs-sm-8 fs-lg-6" data-allow-clear="true"
                                        data-placeholder="Pilih Tipe Pegawai" required>
                                    <option value="">Pilih Tipe Pegawai</option>
                                    <option value="FT">FULL TIME</option>
                                    <option value="PT">PART TIME</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex flex-column mb-2">
                                <label class="d-flex align-items-center fs-sm-8 fs-lg-6 fw-bolder mb-1 required">
                                    <span>Tanggal Masuk</span>
                                </label>
                                <input type="date" id="tanggal_masuk"
                                       class="form-control form-control-sm fs-sm-8 fs-lg-6" required/>
                                <div class="invalid-feedback"></div>
                            </div>








                        </div>

                        <!-- Kolom 3: Alamat -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-dark fs-sm-8 fs-lg-6" data-bs-dismiss="modal"
                            aria-label="Close">Close
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary fs-sm-8 fs-lg-6">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
