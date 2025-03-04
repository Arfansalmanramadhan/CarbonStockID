@extends('layout.layaout')

@section('title', 'Buku')

@section('content')
    <div class="container-tambah-data mt-5" id="currentContent">
        <div class="container-isi">
            <div class="card plot-info-card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="ms-3 mt-2">Informasi Lokasi</h5>
                    @session('success')
                        {{-- <h5 class="ms-3 mt-2">sdsadsa</h5> --}}
                        <div class="toast position-fixed left-0 bottom-0 z-3 ms-4 p-2 mb-3" role="alert" aria-live="assertive"
                            aria-atomic="true" id="myToast">
                            <div class="toast-header border-0">
                                {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                                <strong class="me-auto">Data berhasil dikirim!</strong>
                                {{-- <small>11 mins ago</small> --}}
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Data berhasil dikirim!
                            </div>
                        </div>
                    @endsession
                </div>
                <div class="card-body">
                    <!-- Map Section -->


                    <div id="map" style="width: 100%; height: 400px;"></div>

                    <!-- Form -->
                    <dd></dd>
                    <form method="POST" action="{{ route('Lokasi.store') }}" id="plotAreaForm">
                        @csrf

                        <!-- Input Daerah -->
                        <div class="mb-4">
                            <label for="plotName" class="form-label">Daerah Plot Area</label>
                            <input type="text" class="form-control" name="daerah" id="plotName"
                                placeholder="Masukkan nama daerah pengamatan" required />
                        </div>

                        <!-- Input Latitude -->
                        <div class="mb-4">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" placeholder="Latitude" name="latitude" id="latitude"
                                required />
                        </div>

                        <!-- Input Longitude -->
                        <div class="mb-4">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" placeholder="Longitude" name="longitude"
                                id="longitude" required />
                        </div>
                        <div class="mb-4">
                            <label for="plotName" class="form-label">Jenis hutan</label>
                            <select class="form-select  form-control" aria-label="Default select example" name="jenis_hutan">
                                <option selected>Jenis hutan</option>
                                <option value="Hutan Tropis">Hutan  Tropis</option>
                                <option value="Hutan Bakau">Hutan Bakau</option>
                                <option value="Hutan Sabana">Hutan Sabana</option>
                                <option value="Hutan Rawa Gambut">Hutan Rawa Gambut</option>
                                <option value="Hutan Musim ">Hutan Musim </option>
                                <option value="Hutan Homongen ">Hutan Homongen </option>
                                <option value="Hutan Heterogen ">Hutan Heterogen </option>
                                <option value="Hutan Lindung ">Hutan Lindung </option>
                                <option value="Hutan Suaka Alam ">Hutan Suaka Alam </option>
                                <option value="Hutan Produksi ">Hutan Produksi </option>
                            </select>
                        </div>
                        <!-- Pilih Periode -->
                        <div class="mb-4">
                            <label for="periode_id">Pilih Periode:</label>
                            <select name="periode_id" id="periode_id" class="form-control" required>
                                <option value="">-- Pilih Periode --</option>
                                @foreach ($periodes as $periode)
                                    <option value="{{ $periode->id }}" data-mulai="{{ $periode->tanggal_mulai }}"
                                        data-berakhir="{{ $periode->tanggal_berakhir }}">
                                        {{ $periode->tanggal_mulai }} s/d {{ $periode->tanggal_berakhir }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- Input hidden untuk menyimpan periode_pengamatan -->
                            <input type="hidden" name="periode_pengamatan" id="periode_pengamatan">
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
            <div class="option">
                <a href="{{ route('zona.index') }}" class=" btn btn-success " id="submitButton"><span>Berikutnya</span>
                    <img src="{{ asset('/images/ArrowRight.svg') }}" alt="Arrow Icon" class="ms-2" />
                </a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('periode_id').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let mulai = selectedOption.getAttribute('data-mulai');
            let berakhir = selectedOption.getAttribute('data-berakhir');

            if (mulai && berakhir) {
                document.getElementById('periode_pengamatan').value = mulai + " s/d " + berakhir;
            } else {
                document.getElementById('periode_pengamatan').value = "";
            }
        });
    </script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
@endsection
