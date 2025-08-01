@extends('layout.mainlayaot')

@section('title', 'Galeri')

@section('content')
    <div id="prediksi-content" class="page-content content p-4">
        <div class="image-container mt-4">
            <div class="col page-title">
                <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="img-normal" />
                <p class="large-text text-overlay">Galeri</p>
            </div>
        </div>
        <div class="table-container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            {{-- <form method="post" action="{{ route('Galeri.store') }}" enctype="multipart/form-data" id="uploadForm"> --}}
            <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="row">
                    @csrf
                    {{-- <input type="hidden" name="registrasi_id" value="{{ auth()->user()->id }}"> --}}
                    <div class="col-12 col-md-4">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" value="" name="tanggal" />
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="nama_judul" class="form-label">Judul</label>
                        <input type="text" class="form-control form-control-plot-b" id="nama_judul" value=""
                            name="nama_judul" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="fotoFile" class="form-label">Gambar</label>
                        <input type="file" class="form-control form-control-plot-b" id="fotoFile" value=""
                            name="fotoFile" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="videoFile" class="form-label">Video </label>
                        <input type="file" class="form-control form-control-plot-b" id="videoFile" value=""
                            name="videoFile" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4 align-self-center">
                        <button type="submit" class=" text-center btn btn-success p-3">Simpan</button>
                    </div>
                    {{-- <div class="col-6 col-md-4">
                        <button    type="submit" class="  text-center btn btn-success p-3">Tambah Tim </button>
                    </div> --}}
                    {{-- <div class="col-6 col-md-4 align-self-center">
                        <a href="{{ route('Tambah-Surveyor.indexx') }}"class="  text-center btn btn-success p-3">Tambah
                            Surveyor</a>
                        <button type="submit" class="  text-center btn btn-success p-3">Tambah Surveyor</button>
                    </div> --}}
                </div>
            </form>
            <div class="table-container paginated-table">
                {{-- <div class="table-wrapper"> --}}
                <div class="table-header  d-flex justify-content-between">
                    {{-- <form method="GET" action="{{ route('Manajemen-Tim.index') }}">
                        <div class="tampilkan">
                            <label for="show-entries">Tampilkan</label>
                            <select id="show-entries perPageSelect" class="number-selection" name="perPage"
                                onchange="this.form.submit()">
                                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                            </select>
                            <span class="ms-2">data</span>
                        </div>
                    </form> --}}
                    <div class="tampilkan">
                        <label for="dataPerPage5">Tampilkan</label>
                        <select class="dataPerPage">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ms-2">data</span>
                    </div>
                    <div class="form-control-space">
                        <form method="GET" action="{{ route('Galeri.index', ['id' => $galery->id ?? 'id']) }}">
                            <div class="d-flex align-items-center">
                                <div class="form-control-space">
                                    <input type="text" id="searchInput" name="search" placeholder="Cari..."
                                        class="form-control " value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="btn btn-tambah-data m-3">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table class="custom-table-pancang table  ">
                        <thead>
                            <tr>
                                <th class="kiriPancang">No</th>
                                <th>Tanggal</th>
                                <th>Judul </th>
                                <th>Gambar</th>
                                <th>Video</th>
                                <th class="hidden-column kananPancang">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="tableBody">
                            @forelse($galery as $index => $t)
                                <tr class="data-row">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $t->tanggal }}</td>
                                    <td>{{ $t->nama_judul }}</td>
                                    <td>
                                        @if ($t->foto)
                                            <img src="{{ $t->foto }}" alt="Foto" width="100" height="100"
                                                style="object-fit: cover;">
                                        @else
                                            Tidak ada gambar
                                        @endif
                                    </td>
                                    <td>
                                        @if ($t->video)
                                            <video width="160" height="100" controls>
                                                <source src="{{ $t->video }}" type="video/mp4">
                                                Browser tidak mendukung video.
                                            </video>
                                        @else
                                            Tidak ada video
                                        @endif
                                    </td>

                                    <td class="hidden-column aksi-button">
                                        <a href="{{ route('anggota.indexx', $t->id) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <form action="{{ route('anggota.indexx', $t->id) }}" method="get">
                                            <button type="submit" class="view-btn">
                                                <img src="{{ asset('/images/Eye.svg') }}" alt="" />
                                            </button>
                                        </form>
                                        <form action="{{ route('Manajemen-Tim.deleteTim', ['id' => $t->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                <img src="{{ asset('/images/Trash.svg') }}" alt="Delete" />
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                {{-- <div class="table-footer mt-5">
                        <span>Menampilkan 1 sampai 5 dari 40 data</span>
                        <div class="pagination">
                            <button class="page-btn">Kembali</button>
                            <button class="page-btn active">1</button>
                            <button class="page-btn">2</button>
                            <button class="page-btn">3</button>
                            <button class="page-btn">4</button>
                            <button class="page-btn">Lanjut</button>
                        </div>
                    </div> --}}
                <div class="table-footer mt-5">
                    {{-- <strong>
                        Menampilkan {{ $tim->firstItem() }} sampai {{ $tim->lastItem() }} dari
                        {{ $tim->total() }} data
                    </strong>
                    <nav>
                        <ul class="pagination">

                            @if ($tim->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Kembali</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $tim->previousPageUrl() }}">Kembali</a>
                                </li>
                            @endif


                            @foreach ($tim->getUrlRange(1, $tim->lastPage()) as $page => $url)
                                <li class="page-item {{ $tim->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach


                            @if ($tim->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $tim->nextPageUrl() }}">Lanjut</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Lanjut</span></li>
                            @endif
                        </ul>
                    </nav> --}}
                    <p>Menampilkan data <span class="fromNumber">1</span> sampai <span class="toNumber">5</span>
                        dari
                        <span class="totalData">0</span> data
                    </p>

                    <!-- Tombol Pagination -->
                    <div class="pagination-controls">
                        <button class=" btn-button prevPage" disabled>Sebelumnya</button>
                        <span class="currentPage">1</span> dari <span class="totalPages">0</span>
                        <button class=" btn-button nextPage">Berikutnya</button>
                    </div>
                </div>
                <!-- 🔄 Pagination -->
                {{-- <div class="d-flex justify-content-center">
                    {{ $tim->links() }}
                </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

    <script>
        const supabase = window.supabase.createClient(SUPABASE_URL, SUPABASE_API_KEY);


        // const form = document.getElementById('uploadForm');

        // form.addEventListener('submit', async (e) => {
        //     e.preventDefault();

        //     const galeriId = document.getElementById('galeri_id').value;
        //     const nama_judul = document.getElementById('nama_judul').value;
        //     const tanggal = document.getElementById('tanggal').value;
        //     const fotoFile = document.getElementById('fotoFile').files[0];
        //     const videoFile = document.getElementById('videoFile').files[0];

        //     let foto = null;
        //     let video = null;

        //     if (fotoFile) {
        //         const fotoName = 'foto/' + Date.now() + '-' + fotoFile.name;
        //         const {
        //             error
        //         } = await supabase.storage.from('gambar').upload(fotoName, fotoFile, {
        //             upsert: true
        //         });
        //         if (error) return alert('Gagal upload foto: ' + error.message);
        //         foto = '{{ env('SUPABASE_URL') }}/storage/v1/object/public/gambar/' + fotoName;
        //     }

        //     if (videoFile) {
        //         const videoName = 'video/' + Date.now() + '-' + videoFile.name;
        //         const {
        //             error
        //         } = await supabase.storage.from('gambar').upload(videoName, videoFile, {
        //             upsert: true
        //         });
        //         if (error) return alert('Gagal upload video: ' + error.message);
        //         video = '{{ env('SUPABASE_URL') }}/storage/v1/object/public/gambar/' + videoName;
        //     }

        //     const payload = {
        //         nama_judul,
        //         tanggal,
        //         foto: foto,
        //         video: video,
        //     };

        //     // const url = galeriId ? `/galeri/${galeriId}` : `{{ route('Galeri.store') }}`;
        //     // const method = galeriId ? 'PUT' : 'POST';
        //     const url = `{{ route('Galeri.store') }}`;
        //     const method = 'POST';
        //     const response = await fetch(url, {
        //         method: method,
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         body: JSON.stringify(payload)
        //     });

        //     const result = await response.json();
        //     document.getElementById('result').innerText = result.message || 'Berhasil!';
        // });
        document.getElementById('uploadForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const nama_judul = document.getElementById('nama_judul').value;
            const tanggal = document.getElementById('tanggal').value;
            const fotoFile = document.getElementById('fotoFile').files[0];
            const videoFile = document.getElementById('videoFile').files[0];

            let foto = null;;
            let video = null;


            if (fotoFile) {
                const fotoName = 'foto/' + Date.now() + '-' + fotoFile.name;
                const {
                    error
                } = await supabase.storage.from('gambar').upload(fotoName, fotoFile, {
                    upsert: true
                });
                if (error) return alert('Gagal upload foto: ' + error.message);
                foto = '{{ env('SUPABASE_URL') }}/storage/v2/object/public/gambar/' + fotoName;
            }

            if (videoFile) {
                const videoName = 'video/' + Date.now() + '-' + videoFile.name;
                const {
                    error
                } = await supabase.storage.from('gambar').upload(videoName, videoFile, {
                    upsert: true
                });
                if (error) return alert('Gagal upload video: ' + error.message);
                video = '{{ env('SUPABASE_URL') }}/storage/v2/object/public/gambar/' + videoName;
            }

            const response = await fetch(`{{ route('Galeri.store') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    nama_judul,
                    tanggal,
                    foto,
                    video
                })
            });

            const result = await response.json();
            alert(result.message || 'Berhasil');
            location.reload();
        });
        document.getElementById('perPageSelect').addEventListener('change', function() {
            let perPage = this.value;
            let search = document.getElementById('searchInput').value;
            window.location.href = "{{ route('Manajemen-Tim.index') }}" + "?per_page=" + perPage +
                "&search=" +
                search;
        });

        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                let perPage = document.getElementById('perPageSelect').value;
                let search = this.value;
                window.location.href = "{{ route('Manajemen-Tim.index') }}" + "?per_page=" +
                    perPage + "&search=" +
                    search;
            }
        });
    </script>
@endsection
