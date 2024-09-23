<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/tambahData.css" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Favicon -->
    <link rel="icon" href="assets/img/logoCarbonStockID-LightMode.png" type="image/x-icon" />
    <title>CarbonStockID</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-transparent w-100">
      <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <a href="dashboard.html" class="burger-button">
            <img src="assets/img/leftProfile.svg" alt="Burger Menu" class="burger-icon" />
          </a>
          <a class="navbar-brand d-flex align-items-center ms-3" href="#">
            <img src="assets/img/logoCarbonStockID-DarkMode.png" alt="Logo" width="30" class="d-inline-block align-middle me-2" />
            <span>CarbonStockID</span>
          </a>
        </div>
        <div class="d-flex align-items-center">
          <button class="btn btn-light btn-plot-area d-flex justify-content-between align-items-center">
            <span>Plot Area</span>
            <img src="assets/img/CaretUpFill.svg" alt="Caret Icon" />
          </button>
          <div class="dropdown-plot-area" id="dropdownPlotArea" style="display: none">
            <ul>
              <li class="header-dropdown">Plot Area</li>
              <li id="plotA">Sub Plot A</li>
              <li id="plotB">Sub Plot B</li>
              <li id="plotC">Sub Plot C</li>
              <li id="plotD">Sub Plot D</li>
              <li id="hasilHitung" class="akhir">Hasil Hitung</li>
            </ul>
          </div>
          <img src="assets/img/userIcon.png" alt="User Avatar" id="userIcon" class="ms-3 user-avatar" />
          <div class="user-profile-dropdown" id="userProfileDropdown" style="display: none">
            <div class="user-info">
              <img src="assets/img/userIcon.png" alt="User Avatar" class="user-avatar" />
              <div class="user-details">
                <h4>Chistoper Govert</h4>
                <p>chistoper@gmail.com</p>
              </div>
            </div>
            <hr />
            <div class="user-options">
              <div class="option">
                <img class="me-1" src="assets/img/PersonFill.svg" alt="" />
                <a href="profile.html"><span>Profil Saya</span></a>
              </div>
              <div class="option">
                <img class="ms-1 me-1" src="assets/img/majesticons_logout.svg" alt="" />
                <a href="index.html"><span>Keluar</span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Konten Tambah Data -->
    <div>
        <div class="container-tambah-data mt-5" id="currentContent">
            <div class="container-isi">
                <div class="card plot-info-card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="ms-3 mt-2">Informasi Plot Area</h5>
                    </div>
                    <div class="card-body">
                        <!-- Map Section -->
                        <div id="map"></div>
            
                        <!-- Form -->
                        <form>
                            <div class="mb-4">
                                 <label for="plotName" class="form-label">Daerah Plot Area</label>
                                <input type="text" class="form-control" id="plotName" placeholder="Masukkan nama daerah pengamatan" />
                            </div>
                            <div class="mb-4">
                                <label for="latitude" class="form-label">Latitude</label>
                                 <input type="text" class="form-control-non" id="latitude" readonly />
                            </div>
                            <div class="mb-4">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control-non" id="longitude" readonly />
                             </div>
                        </form>
                    </div>
                </div>
                <button type="submit" class="btn btn-success d-flex align-items-center justify-content-center">
                    <span>Berikutnya</span>
                    <img src="assets/img/ArrowRight.svg" alt="Arrow Icon" class="ms-2" />
                </button>
            </div>
        </div>

      <!-- Konten baru yang akan ditampilkan -->
      <div class="container-tambah-data hidden mt-5" id="newContent">
        <div class="container-isi">
          <div class="card plot-info-card batas">
            <div class="card-header d-flex align-items-center">
              <img class="ms-3 toggle-chevron" src="assets/img/ChevronDown.svg" alt="" />
              <h5 class="ms-3 mt-2">Sub Plot A - Serasah</h5>
            </div>
            <div class="card-body-sup-plot">
              <!-- Form -->
              <form>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Total Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan total berat basah (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan sample berat basah (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Kering</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan sample berat kering (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Total Berat Kering</label>
                  <input type="text" class="form-control-non" id="plotName" placeholder="Masukkan total berat kering (gr)" />
                </div>
                <p class="form-label">Kandungan Karbon <span>xx Kg</span></p>
                <p class="form-label">Serapan CO2 <span>xx Kg</span></p>
              </form>
            </div>
          </div>
          <div class="card plot-info-card batas">
            <div class="card-header d-flex align-items-center">
              <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
              <h5 class="ms-3 mt-2">Sub Plot A - Semai</h5>
            </div>
            <div class="card-body-sup-plot">
              <!-- Form -->
              <form>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Total Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan total berat basah (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan sample berat basah (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Kering</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan sample berat kering (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Total Berat Kering</label>
                  <input type="text" class="form-control-non" id="plotName" placeholder="Masukkan total berat kering (gr)" />
                </div>
                <p class="form-label">Kandungan Karbon <span>xx Kg</span></p>
                <p class="form-label">Serapan CO2 <span>xx Kg</span></p>
              </form>
            </div>
          </div>
          <div class="card plot-info-card batas">
            <div class="card-header d-flex align-items-center">
              <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
              <h5 class="ms-3 mt-2">Sub Plot A - Tumbuhan Bawah</h5>
            </div>
            <div class="card-body-sup-plot">
              <!-- Form -->
              <form>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Total Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan total berat basah (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan sample berat basah (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Kering</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan sample berat kering (gr)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Total Berat Kering</label>
                  <input type="text" class="form-control-non" id="plotName" placeholder="Masukkan total berat kering (gr)" />
                </div>
                <p class="form-label">Kandungan Karbon <span>xx Kg</span></p>
                <p class="form-label">Serapan CO2 <span>xx Kg</span></p>
              </form>
            </div>
          </div>
          <div class="card plot-info-card">
            <div class="card-header d-flex align-items-center">
              <img class="ms-3" src="assets/img/ChevronDown.svg" alt="" />
              <h5 class="ms-3 mt-2">Sub Plot A - Tanah</h5>
            </div>
            <div class="card-body-sup-plot-last">
              <!-- Form -->
              <form>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Kedalaman Sample</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan kedalaman sample (cm)" />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">Sample Berat Basah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan berat jenis tanah " />
                </div>
                <div class="mb-3">
                  <label for="plotName" class="form-label">C Organic Tanah</label>
                  <input type="text" class="form-control" id="plotName" placeholder="Masukkan c organic tanah (%)" />
                </div>
                <p class="form-label">Carbon <span>xx Gr/Cm3</span></p>
                <p class="form-label">Carbon <span>xx Ton/Ha</span></p>
                <p class="form-label">Carbon <span>xx Kg</span></p>
                <p class="form-label">Serapan CO2 <span>xx Kg</span></p>
              </form>
            </div>
          </div>
          <div class="d-flex jarak">
            <button type="submit" class="btn btn-back d-flex align-items-center justify-content-center" id="previousButton">
              <img src="assets/img/ArrowLeft.svg" alt="Arrow Icon" />
              <span class="ms-2">Sebelumnya</span>
            </button>
            <button type="submit" class="btn btn-success btn-success-2 d-flex align-items-center justify-content-center">
              <span>Berikutnya</span>
              <img src="assets/img/ArrowRight.svg" alt="Arrow Icon" class="ms-2" />
            </button>
          </div>
        </div>
      </div>
      <div class="container-tambah-data hidden mt-5" id="newContent2">
        <div class="container-isi">
          <div class="table-container">
            <div class="h2-pancang-container">
              <h2 class="h2-pancang">Pancang</h2>
            </div>
            <div class="table-header d-flex justify-content-between">
              <div class="tampilkan">
                <label for="show-entries">Tampilkan</label>
                <span class="number-selection">5</span>
                <img src="assets/img/downbaru.svg" alt="" class="pancang" id="toggleDropdownBanyakData" />
                <ul class="dropdownData" id="dropdownListDataPlot">
                  <li>5</li>
                  <li>10</li>
                  <li>20</li>
                </ul>
                <span>data</span>
              </div>

              <div class="d-flex align-items-center">
                <!-- Button to trigger modal -->
                <button class="btn btn-tambah-data me-3" id="addData" data-bs-toggle="modal" data-bs-target="#dataModal">Tambah</button>

                <!-- Modal -->
                <div class="modal" id="dataModal" aria-hidden="true">
                  <div class="modal-dialog" id="dataModal">
                    <div class="modal-content">
                      <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot B - Pancang</h5>
                      <div class="modal-body">
                        <form>
                          <!-- Keliling -->
                          <div class="mb-3">
                            <label for="keliling" class="form-label">Keliling</label>
                            <input type="text" class="form-control form-control-plot-b" id="keliling" value="35" />
                          </div>

                          <!-- Diameter -->
                          <div class="mb-3">
                            <label for="diameter" class="form-label">Diameter</label>
                            <input type="text" class="form-control form-control-plot-b-non is-invalid" id="diameter" value="11.1" readonly />
                            <div class="invalid-feedback">Diameter harus diantara 2 hingga 9 cm.</div>
                          </div>

                          <!-- Nama Lokal with Datalist -->
                          <div class="mb-3">
                            <label for="namaLokal" class="form-label">Nama Lokal</label>
                            <div class="input-container">
                              <input type="text" class="form-control form-control-plot-b" id="namaLokal" value="Jati" autocomplete="off" readonly />
                              <img src="assets/img/ChevronUp.svg" alt="" class="chevron-icon" id="toggleDropdown" onclick="toggleImage()" />
                              <ul class="dropdown" id="dropdownList">
                                <li>Damar</li>
                                <li>Jati</li>
                                <li>Mahoni</li>
                              </ul>
                            </div>
                          </div>

                          <!-- Nama Ilmiah -->
                          <div class="mb-3">
                            <label for="namaIlmiah" class="form-label">Nama Ilmiah</label>
                            <input type="text" class="form-control form-control-plot-b-non" id="namaIlmiah" value="Tectona grandis" readonly />
                          </div>

                          <!-- Kerapatan Kayu -->
                          <div class="mb-3">
                            <label for="kerapatanKayu" class="form-label">Kerapatan Jenis Kayu</label>
                            <input type="text" class="form-control form-control-plot-b" id="kerapatanKayu" placeholder="Masukkan kerapatan jenis kayu (gr/cm3)" />
                          </div>

                          <!-- Biomassa, Karbon, CO2 -->
                          <div class="mb-3">
                            <p class="form-label">Biomassa diatas Permukaan Tanah<span>xx Kg</span></p>
                            <p class="form-label">Kandungan Karbon<span>xx Kg</span></p>
                            <p class="form-label">Serapan CO2<span>xx Kg</span></p>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success-plot btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>

                <button class="btn btn-rataan" id="averageData">Rataan</button>
              </div>
            </div>
            <div class="table-wrapper">
              <table class="custom-table-pancang">
                <thead>
                  <tr>
                    <th class="kiriPancang">No</th>
                    <th>Keliling</th>
                    <th>Diameter</th>
                    <th>Nama Lokal</th>
                    <th>Nama Ilmiah</th>
                    <th class="hidden-column">Kerapatan Jenis Kayu</th>
                    <th class="hidden-column">Bio diatas tanah</th>
                    <th class="hidden-column">Kandungan karbon</th>
                    <th class="hidden-column">Serapan CO2</th>
                    <th class="hidden-column kananPancang">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-footer mt-5">
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
          <div class="d-flex jarak">
            <button type="submit" class="btn btn-back d-flex align-items-center justify-content-center" id="previousButton2">
              <img src="assets/img/ArrowLeft.svg" alt="Arrow Icon" />
              <span class="ms-2">Sebelumnya</span>
            </button>
            <button type="submit" class="btn btn-success btn-success-3 d-flex align-items-center justify-content-center">
              <span>Berikutnya</span>
              <img src="assets/img/ArrowRight.svg" alt="Arrow Icon" class="ms-2" />
            </button>
          </div>
        </div>
      </div>
      <div class="container-tambah-data hidden mt-5" id="newContent3">
        <div class="container-isi">
          <div class="table-container">
            <div class="h2-pancang-container section-tiang">
              <h2 class="h2-tiang">Tiang</h2>
            </div>
            <div class="table-header d-flex justify-content-between">
              <div>
                <label for="show-entries">Tampilkan</label>
                <select id="show-entries">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                </select>
                <span>data</span>
              </div>
              <div class="d-flex align-items-center">
                <button class="btn btn-tambah-data me-3" id="addData2" data-bs-toggle="modal" data-bs-target="#dataModal2">Tambah</button>

                <!-- Modal -->
                <div class="modal" id="dataModal2" aria-hidden="true">
                  <div class="modal-dialog" id="dataModal2">
                    <div class="modal-content">
                      <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot C - Tiang</h5>
                      <div class="modal-body">
                        <form>
                          <!-- Keliling -->
                          <div class="mb-3">
                            <label for="keliling" class="form-label">Keliling</label>
                            <input type="text" class="form-control form-control-plot-b" id="keliling" value="35" />
                          </div>

                          <!-- Diameter -->
                          <div class="mb-3">
                            <label for="diameter" class="form-label">Diameter</label>
                            <input type="text" class="form-control form-control-plot-b is-invalid" id="diameter" value="15.27" readonly />
                            <div class="invalid-feedback">Diameter harus diantara 10 hingga 19 cm.</div>
                          </div>

                          <!-- Nama Lokal with Datalist -->
                          <div class="mb-3">
                            <label for="namaLokal2" class="form-label">Nama Lokal</label>
                            <div class="input-container">
                              <input type="text" class="form-control form-control-plot-b" id="namaLokal2" value="Jati" autocomplete="off" readonly />
                              <img src="assets/img/ChevronUp.svg" alt="" class="chevron-icon" id="toggleDropdown2" onclick="toggleImage2()" />
                              <ul class="dropdown" id="dropdownList2">
                                <li>Damar</li>
                                <li>Jati</li>
                                <li>Mahoni</li>
                              </ul>
                            </div>
                          </div>

                          <!-- Nama Ilmiah -->
                          <div class="mb-3">
                            <label for="namaIlmiah" class="form-label">Nama Ilmiah</label>
                            <input type="text" class="form-control form-control-plot-b" id="namaIlmiah" value="Tectona grandis" readonly />
                          </div>

                          <!-- Kerapatan Kayu -->
                          <div class="mb-3">
                            <label for="kerapatanKayu" class="form-label">Kerapatan Jenis Kayu</label>
                            <input type="text" class="form-control form-control-plot-b" id="kerapatanKayu" placeholder="Masukkan kerapatan jenis kayu (gr/cm3)" />
                          </div>

                          <!-- Biomassa, Karbon, CO2 -->
                          <div class="mb-3">
                            <p class="form-label">Biomassa diatas Permukaan Tanah<span>xx Kg</span></p>
                            <p class="form-label">Kandungan Karbon<span>xx Kg</span></p>
                            <p class="form-label">Serapan CO2<span>xx Kg</span></p>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success-plot btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="btn btn-rataan" id="averageData">Rataan</button>
              </div>
            </div>
            <div class="table-wrapper">
              <table class="custom-table-pancang">
                <thead>
                  <tr>
                    <th class="kiriPancang">No</th>
                    <th>Keliling</th>
                    <th>Diameter</th>
                    <th>Nama Lokal</th>
                    <th>Nama Ilmiah</th>
                    <th class="hidden-column">Kerapatan Jenis Kayu</th>
                    <th class="hidden-column">Bio diatas tanah</th>
                    <th class="hidden-column">Kandungan karbon</th>
                    <th class="hidden-column">Serapan CO2</th>
                    <th class="hidden-column kananPancang">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>48 cm</td>
                    <td>15.27 cm</td>
                    <td>Jati</td>
                    <td>Tectona grandis</td>
                    <td class="hidden-column">0.61 gr/cm3</td>
                    <td class="hidden-column">84.84 kg</td>
                    <td class="hidden-column">39.87 kg</td>
                    <td class="hidden-column">146.20 kg</td>
                    <td class="hidden-column aksi-button">
                      <button class="edit-btn">
                        <img src="assets/img/PencilSquare.svg" alt="" />
                      </button>
                      <button class="delete-btn">
                        <img src="assets/img/Trash.svg" alt="" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-footer mt-5">
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
          <div class="d-flex jarak">
            <button type="submit" class="btn btn-back d-flex align-items-center justify-content-center" id="previousButton3">
              <img src="assets/img/ArrowLeft.svg" alt="Arrow Icon" />
              <span class="ms-2">Sebelumnya</span>
            </button>
            <button type="submit" class="btn btn-success btn-success-4 d-flex align-items-center justify-content-center">
              <span>Berikutnya</span>
              <img src="assets/img/ArrowRight.svg" alt="Arrow Icon" class="ms-2" />
            </button>
          </div>
        </div>
      </div>
      <div class="container-tambah-data hidden mt-5" id="newContent4">
        <div class="container-isi">
          <div class="table-container-plotD">
            <div class="h2-plotD-container">
              <h2 class="me-3 active" id="pohonBtn">Pohon</h2>
              <h2 id="nekromasBtn">Nekromas</h2>
            </div>
            <!-- Konten Nekromas -->
            <div id="nekromasContent" class="content-plotD">
              <div class="table-header d-flex justify-content-between">
                <div>
                  <label for="show-entries">Tampilkan</label>
                  <select id="show-entries">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                  </select>
                  <span>data</span>
                </div>
                <div class="d-flex align-items-center">
                  <button class="btn btn-tambah-data me-3" id="addData3" data-bs-toggle="modal" data-bs-target="#dataModal3">Tambah</button>

                  <!-- Modal -->
                  <div class="modal" id="dataModal3" aria-hidden="true">
                    <div class="modal-dialog" id="dataModal3">
                      <div class="modal-content">
                        <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot D - Pohon</h5>
                        <div class="modal-body">
                          <form>
                            <!-- Keliling -->
                            <div class="mb-3">
                              <label for="keliling" class="form-label">Keliling</label>
                              <input type="text" class="form-control form-control-plot-b" id="keliling" value="35" />
                            </div>

                            <!-- Diameter -->
                            <div class="mb-3">
                              <label for="diameter" class="form-label">Diameter</label>
                              <input type="text" class="form-control form-control-plot-b is-invalid" id="diameter" value="15.27" readonly />
                              <div class="invalid-feedback">Diameter harus diantara 10 hingga 19 cm.</div>
                            </div>

                            <!-- Nama Lokal with Datalist -->
                            <div class="mb-3">
                              <label for="namaLokal" class="form-label">Nama Lokal</label>
                              <div class="input-container">
                                <input type="text" class="form-control form-control-plot-b" id="namaLokal3" value="Jati" autocomplete="off" readonly />
                                <img src="assets/img/ChevronUp.svg" alt="" class="chevron-icon" id="toggleDropdown3" onclick="toggleImage3()" />
                                <ul class="dropdown" id="dropdownList3">
                                  <li>Damar</li>
                                  <li>Jati</li>
                                  <li>Mahoni</li>
                                </ul>
                              </div>
                            </div>

                            <!-- Nama Ilmiah -->
                            <div class="mb-3">
                              <label for="namaIlmiah" class="form-label">Nama Ilmiah</label>
                              <input type="text" class="form-control form-control-plot-b" id="namaIlmiah" value="Tectona grandis" readonly />
                            </div>

                            <!-- Kerapatan Kayu -->
                            <div class="mb-3">
                              <label for="kerapatanKayu" class="form-label">Kerapatan Jenis Kayu</label>
                              <input type="text" class="form-control form-control-plot-b" id="kerapatanKayu" placeholder="Masukkan kerapatan jenis kayu (gr/cm3)" />
                            </div>

                            <!-- Biomassa, Karbon, CO2 -->
                            <div class="mb-3">
                              <p class="form-label">Biomassa diatas Permukaan Tanah<span>xx Kg</span></p>
                              <p class="form-label">Kandungan Karbon<span>xx Kg</span></p>
                              <p class="form-label">Serapan CO2<span>xx Kg</span></p>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success-plot btn-primary">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-rataan" id="averageData">Rataan</button>
                </div>
              </div>
              <div class="table-wrapper">
                <table class="custom-table-pancang">
                  <thead>
                    <tr>
                      <th class="kiriPancang">No</th>
                      <th>Keliling</th>
                      <th>Diameter</th>
                      <th>Nama Lokal</th>
                      <th>Nama Ilmiah</th>
                      <th class="hidden-column">Kerapatan Jenis Kayu</th>
                      <th class="hidden-column">Bio diatas tanah</th>
                      <th class="hidden-column">Kandungan karbon</th>
                      <th class="hidden-column">Serapan CO2</th>
                      <th class="hidden-column kananPancang">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-footer mt-5">
                <span>Menampilkan 1 sampai 5 dari 40 data</span>
                <div class="pagination">
                  <button class="page-btn">Kembali</button>
                  <button class="page-btn activeD">1</button>
                  <button class="page-btn">2</button>
                  <button class="page-btn">3</button>
                  <button class="page-btn">4</button>
                  <button class="page-btn">Lanjut</button>
                </div>
              </div>
            </div>

            <!-- Konten Pohon -->
            <div id="pohonContent" class="content-plotD">
              <div class="table-header d-flex justify-content-between">
                <div>
                  <label for="show-entries">Tampilkan</label>
                  <select id="show-entries">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                  </select>
                  <span>data</span>
                </div>
                <div class="d-flex align-items-center">
                  <button class="btn btn-tambah-data me-3" id="addData4" data-bs-toggle="modal" data-bs-target="#dataModal4">Tambah</button>

                  <!-- Modal -->
                  <div class="modal" id="dataModal4" aria-hidden="true">
                    <div class="modal-dialog" id="dataModal4">
                      <div class="modal-content">
                        <h5 class="ms-3 modal-title" id="dataModalLabel">Sub Plot D - Pohon</h5>
                        <div class="modal-body">
                          <form>
                            <!-- Keliling -->
                            <div class="mb-3">
                              <label for="keliling" class="form-label">Keliling</label>
                              <input type="text" class="form-control form-control-plot-b" id="keliling" value="35" />
                            </div>

                            <!-- Diameter -->
                            <div class="mb-3">
                              <label for="diameter" class="form-label">Diameter</label>
                              <input type="text" class="form-control form-control-plot-b is-invalid" id="diameter" value="15.27" readonly />
                              <div class="invalid-feedback">Diameter harus diantara 10 hingga 19 cm.</div>
                            </div>

                            <!-- Nama Lokal with Datalist -->
                            <div class="mb-3">
                              <label for="namaLokal" class="form-label">Nama Lokal</label>
                              <div class="input-container">
                                <input type="text" class="form-control form-control-plot-b" id="namaLokal4" value="Jati" autocomplete="off" readonly />
                                <img src="assets/img/ChevronUp.svg" alt="" class="chevron-icon" id="toggleDropdown4" onclick="toggleImage4()" />
                                <ul class="dropdown" id="dropdownList4">
                                  <li>Damar</li>
                                  <li>Jati</li>
                                  <li>Mahoni</li>
                                </ul>
                              </div>
                            </div>

                            <!-- Nama Ilmiah -->
                            <div class="mb-3">
                              <label for="namaIlmiah" class="form-label">Nama Ilmiah</label>
                              <input type="text" class="form-control form-control-plot-b" id="namaIlmiah" value="Tectona grandis" readonly />
                            </div>

                            <!-- Kerapatan Kayu -->
                            <div class="mb-3">
                              <label for="kerapatanKayu" class="form-label">Kerapatan Jenis Kayu</label>
                              <input type="text" class="form-control form-control-plot-b" id="kerapatanKayu" placeholder="Masukkan kerapatan jenis kayu (gr/cm3)" />
                            </div>

                            <!-- Biomassa, Karbon, CO2 -->
                            <div class="mb-3">
                              <p class="form-label">Biomassa diatas Permukaan Tanah<span>xx Kg</span></p>
                              <p class="form-label">Kandungan Karbon<span>xx Kg</span></p>
                              <p class="form-label">Serapan CO2<span>xx Kg</span></p>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success-plot btn-primary">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-rataan" id="averageData">Rataan</button>
                </div>
              </div>
              <div class="table-wrapper">
                <table class="custom-table-pancang">
                  <thead>
                    <tr>
                      <th class="kiriPancang">No</th>
                      <th>Keliling</th>
                      <th>Diameter</th>
                      <th>Nama Lokal</th>
                      <th>Nama Ilmiah</th>
                      <th class="hidden-column">Kerapatan Jenis Kayu</th>
                      <th class="hidden-column">Bio diatas tanah</th>
                      <th class="hidden-column">Kandungan karbon</th>
                      <th class="hidden-column">Serapan CO2</th>
                      <th class="hidden-column kananPancang">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>48 cm</td>
                      <td>15.27 cm</td>
                      <td>Jati</td>
                      <td>Tectona grandis</td>
                      <td class="hidden-column">0.61 gr/cm3</td>
                      <td class="hidden-column">84.84 kg</td>
                      <td class="hidden-column">39.87 kg</td>
                      <td class="hidden-column">146.20 kg</td>
                      <td class="hidden-column aksi-button">
                        <button class="edit-btn">
                          <img src="assets/img/PencilSquare.svg" alt="" />
                        </button>
                        <button class="delete-btn">
                          <img src="assets/img/Trash.svg" alt="" />
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-footer mt-5">
                <span>Menampilkan 1 sampai 5 dari 40 data</span>
                <div class="pagination">
                  <button class="page-btn">Kembali</button>
                  <button class="page-btn activeD">1</button>
                  <button class="page-btn">2</button>
                  <button class="page-btn">3</button>
                  <button class="page-btn">4</button>
                  <button class="page-btn">Lanjut</button>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex jarak">
            <button type="submit" class="btn btn-back d-flex align-items-center justify-content-center" id="previousButton4">
              <img src="assets/img/ArrowLeft.svg" alt="Arrow Icon" />
              <span class="ms-2">Sebelumnya</span>
            </button>
            <button type="submit" class="btn btn-success btn-success-5 d-flex align-items-center justify-content-center">
              <span>Hasil</span>
              <img src="assets/img/ArrowRight.svg" alt="Arrow Icon" class="ms-2" />
            </button>
          </div>
        </div>
      </div>
      <div class="container-tambah-data hidden mt-5" id="newContent5">
        <div class="container-isi">
          <div class="table-container">
            <div class="h2-pancang-container section-hasil">
              <h2 class="h2-tiang">Ringkasan Hitungan</h2>
            </div>
            <div class="frame-no-data">
              <img src="assets/img/imageNoData.svg" alt="" />
              <p>Data yang Anda masukkan masih kosong. Mohon lengkapi semua informasi yang diperlukan.</p>
            </div>
            <!-- <div class="table-header-hasil d-flex">
              <button class="btn btn-unduhPDF" id="averageData">Unduh PDF</button>
            </div>
            <div class="plot-info">
              <p>Nomor Plot : 0001</p>
              <p>Daerah Plot : Mekarjaya, Kec. Banjaran, Kabupaten Bandung</p>
              <p>Latitude : -6.86617089575936</p>
              <p>Longitude : 107.64260905148411</p>
            </div>
            <table class="custom-table-hasil">
              <thead class="me-4">
                <tr>
                  <th>NAMA PERHITUNGAN</th>
                  <th>TOTAL CO2</th>
                </tr>
              </thead>
              <tbody class="me-4">
                <tr>
                  <td>Berat bio akar</td>
                  <td>414.17 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Bio tanah</td>
                  <td>1380.58 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Necromas</td>
                  <td>138.06 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Tumbuhan bawah</td>
                  <td>82.83 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Serasah</td>
                  <td>55.23 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Semai</td>
                  <td>27.61 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Pancang</td>
                  <td>110.45 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Tiang</td>
                  <td>276.12 Ton C/Ha</td>
                </tr>
                <tr>
                  <td>Pohon</td>
                  <td>276.12 Ton C/Ha</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td>TOTAL CADANGAN KARBON CO2</td>
                  <td>2,761.15 Ton C/Ha</td>
                </tr>
              </tfoot>
            </table> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Custom JS -->
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
    <script src="{{ asset('js/tambahData.js') }}"></script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>