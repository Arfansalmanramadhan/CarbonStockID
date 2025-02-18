@extends('layout.mainlayaot')

@section('title', 'Surveyor')

@section('content')
    <div id="prediksi-content" class="page-content content p-4 w-10">
        <div class="image-container mt-4 row">
            <div class="col">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
                <p class="large-text text-overlay">Manajermen Surveyor</p>
            </div>
        </div>
        <div class="row bg-putih pb-4">
            <div class="row">
                <div class="col">
                    <label for="keliling" class="form-label">pilih lokasih</label>
                    <input type="text" class="form-control form-control-plot-b" id="keliling" value=""
                        name="Jenis_tanaman" />
                </div>
                <div class="col">
                    <label for="keliling" class="form-label">Nama SUrveyor</label>
                    <select class="form-select  form-control" aria-label="Default select example" name="zona">
                        <option selected>Zona</option>
                        <option value="Zona 1">Zona 1</option>
                        <option value="Zona 2">Zona 2</option>
                        <option value="Zona 3">Zona 3</option>
                        <option value="Zona 4">Zona 4</option>
                        <option value="Zona 5">Zona 5</option>
                    </select>
                </div>
                <div class="col align-self-center">
                    <button type="submit" class="  text-center btn btn-success p-3">Simpan</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="keliling" class="form-label">Tanggal</label>
                    <input type="text" class="form-control form-control-plot-b" id="keliling" value=""
                        name="Jenis_tanaman" />
                </div>
                <div class="col mt-4 align-self-center">
                    <button type="submit" class="  text-center btn btn-success p-3">Detail</button>
                </div>
                <div class="col align-self-center">
                    <button type="submit" class="  text-center btn btn-success p-3">Tambah Surveyor</button>
                </div>
            </div>
            <div class="table-container">
                <div class="table-header">
                    <label for="show-entries">Tampilkan</label>
                    <select id="show-entries">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                    <span>data</span>
                </div>
                <table class="custom-table-hasil table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Surveyor</th>
                            <th>Lokasi</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>00001</td>
                            <td>bandung</td>
                            <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                            <td class="aksi-dataplot">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>00001</td>
                            <td>bandung</td>
                            <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                            <td class="aksi-dataplot">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>00001</td>
                            <td>bandung</td>
                            <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                            <td class="aksi-dataplot">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>00001</td>
                            <td>bandung</td>
                            <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                            <td class="aksi-dataplot">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>00001</td>
                            <td>bandung</td>
                            <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                            <td class="aksi-dataplot">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>00002</td>
                            <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                            <td class="aksi-dataplot">
                                <button class="view-btn">
                                    <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                </button>
                                <button class="edit-btn">
                                    <img src="{{ asset('/images/PencilSquare.svg') }}" alt="" />
                                </button>
                                <button class="delete-btn">
                                    <img src="{{ asset('/images/Trash.svg') }}" alt="" />
                                </button>

                                <!-- Modal -->
                                <div id="deleteModal" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="close">&times;</span>
                                            <img src="" alt="Delete Icon" class="icon" />
                                        </div>
                                        <div class="modal-body">
                                            <h2>Kamu yakin untuk menghapus Plot Area ini?</h2>
                                            <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan
                                                dipindahkan
                                                ke Sampah.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancelBtn" class="cancel-btn">Batal</button>
                                            <button id="deleteBtn" class="delete-confirm-btn">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- Tambahkan baris lainnya di sini -->
                    </tbody>
                </table>
                <div class="table-footer">
                    <span>Menampilkan 1 sampai 5 dari 40 data</span>
                    <div class="pagination">
                        <button class="page-btn">Kembali</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
