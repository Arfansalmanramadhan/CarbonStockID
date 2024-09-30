<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styleDashboard.css') }}" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/images/logoCarbonStockID-LightMode.png') }}" type="image/x-icon" />
    <title>CarbonStockID</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-transparent w-100">
      <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <button class="burger-button">
            <img src="{{ asset('/images/burgerIcon.png') }}" alt="Burger Menu" class="burger-icon" />
          </button>
          <a class="navbar-brand d-flex align-items-center ms-3" href="#">
            <img src="{{ asset('/images/logoCarbonStockID-DarkMode.png') }}" alt="Logo" width="30" class="d-inline-block align-middle me-2" />
            <span>CarbonStockID</span>
          </a>
        </div>
        <div class="d-flex align-items-center">
          <form class="d-flex me-2 position-relative" role="search">
            <input class="form-control search-input" type="search" placeholder="Cari..." aria-label="Search" />
            <img src="{{ asset('/images/iconSearch.png') }}" alt="Search Icon" class="search-icon" />
          </form>
          <a href="{{ url('/tambahData') }}" class="btn btn-light btn-tambahData">Tambah data</a>
          <img src="{{ $profil->image ? asset($profil->image) : asset('/images/PersonFill.svg') }}" alt="User Avatar" id="userIcon" class="ms-3 user-avatar" />
          <div class="user-profile-dropdown" id="userProfileDropdown" style="display: none">
            <div class="user-info">
              <img src="{{ $profil->image ? asset($profil->image) : asset('/images/PersonFill.svg') }}" alt="User Avatar" id="userIcon" class="ms-3 user-avatar" />
              <div class="user-details">
                <h4>{{ $user->username }}</h4>
                <p>{{ $user->email }}</p>
              </div>
            </div>
            <hr />
            <div class="user-options">
              <div class="option">
                <img class="me-1" src="{{ asset('/images/PersonFill.svg') }}" alt="" />
                <a href="/profile"><span>Profil Saya</span></a>
              </div>
              <div class="option">
                <img class="ms-1 me-1" src="{{ asset('/images/majesticons_logout.svg') }}" alt="" />
                <a href="{{ url('') }}"><span>Keluar</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Sidebar -->
    <div class="d-flex">
      <div class="sidebar bg-light p-3" id="sidebar">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="d-flex align-items-center ms-3 nav-link active" href="#beranda">
              <img src="{{ asset('/images/iconamoon_home-fill.svg') }}" alt="Home Icon" />
              <span class="ms-2">Beranda</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center ms-3 nav-link" href="#panduan">
              <img src="{{ asset('/images/FileEarmarkPdfFill.svg') }}" alt="Guide Icon" />
              <span class="ms-2">Panduan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center ms-3 nav-link" href="#data-plot">
              <img src="{{ asset('/images/FolderFill.svg') }}" alt="Data Plot Icon" />
              <span class="ms-2">Data Plot</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center ms-3 nav-link" href="#prediksi">
              <img src="{{ asset('/images/prediksiLogo.svg') }}" alt="Guide Icon" />
              <span class="ms-2">Prediksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="d-flex align-items-center ms-3 nav-link" href="#sampah">
              <img src="{{ asset('/images/TrashFill.svg') }}" alt="Trash Icon" />
              <span class="ms-2">Sampah</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="content p-4 w-100">
        <!-- Content for Beranda (default visible) -->
        <div id="beranda-content" class="page-content active mt-2">
          <h4 class="judul-beranda">Data Plot Area</h4>
          <table class="custom-table-hasil">
            <thead class="me-4">
              <tr>
                <th>NOMOR</th>
                <th>DAERAH</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
              </tr>
            </thead>
            <tbody class="me-4">
              <tr>
                <td>00001</td>
                <td>Mekar Jaya, Me...</td>
                <td>-6.937154839...</td>
                <td>6.937178839...</td>
              </tr>
              <tr>
                <td>00001</td>
                <td>Mekar Jaya, Me...</td>
                <td>-6.937154839...</td>
                <td>6.937178839...</td>
              </tr>
              <tr>
                <td>00001</td>
                <td>Mekar Jaya, Me...</td>
                <td>-6.937154839...</td>
                <td>6.937178839...</td>
              </tr>
            </tbody>
          </table>
          <h4 class="judul-beranda mt-5">Prediksi Emisi Karbon Indonesia</h4>
          <canvas id="carbonEmissionsChart" width="400" height="200"></canvas>
        </div>
        <div id="panduan-content" class="page-content">
          <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <div class="text-overlay">
              <p class="large-text">Panduan Perhitungan Cadangan Karbon</p>
            </div>
          </div>
          <div class="pdf-container">
            <iframe src="File/SNI7724_Pengukuran Lapangan Cadangan Karbon.pdf" class="pdf-frame"></iframe>
          </div>
        </div>
        <!-- Content for Data Plot (initially hidden) -->
        <div id="data-plot-content" class="page-content">
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
                  <th>DAERAH</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>00001</td>
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

                    <!-- Modal -->
                    <div id="deleteModal" class="modal">
                      <div class="modal-content">
                        <div class="modal-header">
                          <span class="close">&times;</span>
                          <img src="" alt="Delete Icon" class="icon" />
                        </div>
                        <div class="modal-body">
                          <h2>Kamu yakin untuk menghapus Plot Area ini?</h2>
                          <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan ke Sampah.</p>
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
                          <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan ke Sampah.</p>
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
                          <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan ke Sampah.</p>
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
                          <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan ke Sampah.</p>
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
                          <p>Jika anda menghapus plot area ini, semua data terkait plot ini akan dipindahkan ke Sampah.</p>
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
        <div id="prediksi-content" class="page-content">
          <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <p class="large-text text-overlay">Prediksi Cadangan Karbon</p>
          </div>
        </div>
        <div id="sampah-content" class="page-content">
          <div class="image-container mt-4">
            <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
            <div class="text-overlay">
              <p class="large-text">Sampah</p>
            </div>
          </div>
          <div class="table-container-sampah">
            <div class="table-header-sampah">
              <div class="tampilkan-data">
                <label for="show-entries">Tampilkan</label>
                <span class="number-selection-data">5</span>
                <img src="{{ asset('/images/downbaru.svg') }}" alt="" class="pancang" id="toggleDropdownBanyakData" />
                <ul class="dropdownJumlahData" id="dropdownListDataPlot">
                  <li>5</li>
                  <li>10</li>
                  <li>20</li>
                </ul>
                <span class="ms-2">data</span>
              </div>
              <div class="tampilkan">
                <span class="number-selection">Hapus Semua</span>
                <img src="{{ asset('/images/CaretDownFill.svg') }}" alt="" class="pancang" id="toggleDropdownBanyakData" />
                <ul class="dropdownData" id="dropdownListDataPlot">
                  <li>Hapus Semua</li>
                  <li>Pulihkan Semua</li>
                </ul>
                <input class="form-check-sampah" type="checkbox" id="rememberMe" />
              </div>
            </div>
            <div class="table-tengah-sampah d-flex">
              <h6>Data di Sampah otomatis terhapus setelah 30 hari.</h6>
              <span>Kosongkan Sampah sekarang</span>
            </div>
            <table class="sampah-table">
              <tbody>
                <tr>
                  <td>0001</td>
                  <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                  <td class="aksi-button">
                    <button class="restrore-btn-sampah">
                      <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                    </button>
                    <button class="delete-btn-sampah">
                      <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                    </button>
                    <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                  </td>
                </tr>
                <tr>
                  <td>0001</td>
                  <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                  <td class="aksi-button">
                    <button class="restrore-btn-sampah">
                      <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                    </button>
                    <button class="delete-btn-sampah">
                      <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                    </button>
                    <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                  </td>
                </tr>
                <tr>
                  <td>0001</td>
                  <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                  <td class="aksi-button">
                    <button class="restrore-btn-sampah">
                      <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                    </button>
                    <button class="delete-btn-sampah">
                      <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                    </button>
                    <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                  </td>
                </tr>
                <tr>
                  <td>0001</td>
                  <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                  <td class="aksi-button">
                    <button class="restrore-btn-sampah">
                      <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                    </button>
                    <button class="delete-btn-sampah">
                      <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                    </button>
                    <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                  </td>
                </tr>
                <tr>
                  <td>0001</td>
                  <td>Mekarjaya, Kec. Banjaran, Kabupaten Bandung</td>
                  <td class="aksi-button">
                    <button class="restrore-btn-sampah">
                      <img src="{{ asset('/images/restoreIcon.svg') }}" alt="" />
                    </button>
                    <button class="delete-btn-sampah">
                      <img src="{{ asset('/images/sampahIconItem.svg') }}" alt="" />
                    </button>
                    <input class="form-check-sampah" type="checkbox" id="rememberMe" />
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="table-footer-data mt-5">
              <span>Menampilkan 1 sampai 5 dari 40 data</span>
              <div class="pagination-data">
                <button class="page-btn-data">Kembali</button>
                <button class="page-btn-data active">1</button>
                <button class="page-btn-data">2</button>
                <button class="page-btn-data">3</button>
                <button class="page-btn-data">4</button>
                <button class="page-btn-data">Lanjut</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Custom JS -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial"></script>

    <script src="{{ asset('js/scriptDashboard.js') }}"></script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
