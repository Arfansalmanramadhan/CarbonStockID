@extends('layout.mainlayaot')

@section('title', "Buku")
    
@section('content')
<div id="prediksi-content" class="page-content content p-4 w-10">
    <div class="image-container mt-4">
      <img src="{{ asset('/images/dataPlot-Image.svg') }}" alt="" class="mb-4 img-normal" />
      <p class="large-text text-overlay">Prediksi Cadangan Karbon</p>
    </div>
    <div id="carbon-prediction-chart"></div>
  </div>
@endsection