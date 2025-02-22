@extends('layout.mainlayaot')

@section('title', 'Buku')

@section('content')
    <div id="data-plot-content" class="page-content content p-4 w-100 col-lg-10">
        <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <div class="text-overlay">
                <p class="small-text">Data Plot</p>
                <p class="large-text">Data Plot Area</p>
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
            <table class="custom-table-hasil">
                <thead>
                    <tr>
                        <th>NOMOR</th>
                        <th>TIPE PLOT</th>
                        <th>KOORDINAT</th>
                        <th>DAERAH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>00001</td>
                        <td>Bujursangkar</td>
                        <td>-6.9705, 107.6304</td>
                        <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                        <td class="hidden-column aksi-button">
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
                                        <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
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
                    <tr>
                        <td>00002</td>
                        <td>Bujursangkar</td>
                        <td>-6.9705, 107.6304</td>
                        <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                        <td class="hidden-column aksi-button">
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
                                        <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
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
                    <tr>
                        <td>00003</td>
                        <td>Persegi panjang</td>
                        <td>-6.9705, 107.6304</td>
                        <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                        <td class="hidden-column aksi-button">
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
                                        <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
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
                    <tr>
                        <td>00004</td>
                        <td>Persegi panjang</td>
                        <td>-6.9705, 107.6304</td>
                        <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                        <td class="hidden-column aksi-button">
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
                                        <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
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
                    <tr>
                        <td>00005</td>
                        <td>Bujursangkar</td>
                        <td>-6.9705, 107.6304</td>
                        <td>Haurpanggung, Kec. Tarogong Kidul, Kabupaten ...</td>
                        <td class="hidden-column aksi-button">
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
                                        <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan
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
@endsection
