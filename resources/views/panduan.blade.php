@extends('layout.mainlayaot')

@section('title', "Buku")
    
@section('content')
   <div id="panduan-content" class=" page-content  content p-4 w-100 col-lg-10">
    <div class=" image-container mt-4 ">
      <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
      <div class="text-overlay">
        <p class="large-text">Panduan Perhitungan Cadangan Karbon</p>
      </div>
    </div>
    <div class="pdf-container container content">
      <iframe src="File/SNI7724_Pengukuran Lapangan Cadangan Karbon.pdf" class="pdf-frame"></iframe>
    </div>
  </div>
@endsection