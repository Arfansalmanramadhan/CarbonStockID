@extends('layout.mainlayaot')

@section('title', "Buku")
    
@section('content')
<div class="d-flex">
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
</div>
  @endsection