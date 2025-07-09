@extends('layout.mainlayaot')

@section('title', 'Peta Monitoring Karbon')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 position-relative">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Peta Monitoring Karbon</strong></h3>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div id="map" style="height: 600px; width: 100%;"></div>
                        <div id="info-panel" class="info-panel">
                            <p>Klik marker untuk melihat detail plot area</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <style>
            .info-panel {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 360px;
                max-height: 500px;
                overflow-y: auto;
                background: #fff;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                font-size: 14px;
            }

            .info-panel table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            .info-panel thead th {
                background-color: #5cb85c;
                color: #fff;
                padding: 8px;
                text-align: left;
                font-weight: 600;
            }

            .info-panel tbody tr:nth-child(odd) {
                background-color: #f7fdf7;
            }

            .info-panel td,
            .info-panel th {
                border: 1px solid #5cb85c;
                padding: 6px 8px;
            }

            .info-panel tfoot td {
                background-color: #f7fdf7;
                font-weight: 600;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const map = L.map('map').setView([-6.9175, 107.6191], 10);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 18
                }).addTo(map);

                const infoPanel = document.getElementById('info-panel');
                const updateInfo = html => infoPanel.innerHTML = html;

                fetch('/zones/plot-area')
                    .then(r => r.json())
                    .then(res => {
                        if (!res.success) throw new Error(res.message || 'Gagal memuat plot area');
                        renderPlotAreas(res.data);
                    })
                    .catch(e => updateInfo(`<div class="alert alert-danger">Error: ${e.message}</div>`));

                function renderPlotAreas(areas) {
                    const bounds = [];
                    areas.forEach(a => {
                        if (!a.latitude || !a.longitude) return;
                        const lat = +a.latitude,
                            lng = +a.longitude;
                        const m = L.circleMarker([lat, lng], {
                            radius: 8,
                            fillColor: '#28a745',
                            color: '#fff',
                            weight: 2,
                            opacity: 1,
                            fillOpacity: 0.8
                        }).addTo(map);

                        m.bindPopup(`
        <div style="text-align:center">
          <h6><strong>${a.daerah}</strong></h6>
          <button class="btn btn-sm btn-primary"
            onclick="showDetails('${a.slug}', '${a.daerah}')">
            Lihat Detail
          </button>
        </div>
      `);
                        bounds.push([lat, lng]);
                    });
                    if (bounds.length) map.fitBounds(bounds, {
                        padding: [20, 20]
                    });
                }

                window.showDetails = (slug, name) => {
                    updateInfo(`
    <div class="text-center">
      <div class="spinner-border"></div>
      <p>Memuat data: <strong>${name}</strong>…</p>
    </div>
  `);

                    fetch(`/zones/${slug}/summary`)
                        .then(r => r.json())
                        .then(res => {
                            const obj = res.data[0];

                            const rows = [{
                                    label: 'Serasah',
                                    co2: parseFloat(obj.Serasahco2),
                                    luas: parseFloat(obj.faktor),
                                    total: parseFloat(obj.Serasah),
                                    persen: parseFloat(obj.hasilSerasahPersen)
                                },
                                {
                                    label: 'Necromass',
                                    co2: parseFloat(obj.Necromassco2),
                                    luas: parseFloat(obj.faktor),
                                    total: parseFloat(obj.Necromass),
                                    persen: parseFloat(obj.hasilNecromassPersen)
                                },
                                {
                                    label: 'CO₂ Tanaman',
                                    co2: parseFloat(obj.Co2Tanaman),
                                    luas: parseFloat(obj.faktor),
                                    total: parseFloat(obj.TotalCarbonn),
                                    persen: parseFloat(obj.hasilco2tanamanPersen)
                                },
                                {
                                    label: 'Tanah',
                                    co2: parseFloat(obj.TanahCo2),
                                    luas: parseFloat(obj.tanah),
                                    total: parseFloat(obj.TanahCarbon),
                                    persen: parseFloat(obj.hasiltanahPersen)
                                },
                                {
                                    label: 'Berat biomasa akar',
                                    co2: parseFloat(obj.BeratBiomassaAkar),
                                    luas: parseFloat(obj.faktor),
                                    total: parseFloat(obj.beratMasaAkar),
                                    persen: parseFloat(obj.hasilakarPersen)
                                },
                            ];

                            let html = `
        <h6>Rekapan Perhitungan Carbon 5 Poll di ${name}</h6>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penghitungan</th>
              <th>Total CO₂</th>
              <th>Luas Tanah (ha)</th>
              <th>Total</th>
              <th>Persen</th>
            </tr>
          </thead>
          <tbody>
      `;

                            rows.forEach((r, i) => {
                                html += `
          <tr>
            <td>${i+1}</td>
            <td>${r.label}</td>
            <td>${r.co2.toFixed(2)} Ton C/Ha</td>
            <td>${r.luas.toFixed(2)} Ha</td>
            <td>${r.total.toFixed(2)} Ton C/Ha</td>
            <td>${r.persen.toFixed(2)} %</td>
          </tr>
        `;
                            });

                            html += `
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4"><strong>Total Carbon 5 Poll</strong></td>
              <td colspan="2">${parseFloat(obj.TotalKaoobon).toFixed(2)} Ton</td>
            </tr>
            <tr>
              <td colspan="4"><strong>Baseline Lahan Kosong</strong></td>
              <td colspan="2">${parseFloat(obj.BaselineLahanKosong).toFixed(2)} Ton C/Ha</td>
            </tr>
          </tfoot>
        </table>
      `;

                            updateInfo(html);
                        })
                        .catch(e => updateInfo(`<div class="alert alert-danger">Error: ${e.message}</div>`));
                };

                // 4) Legend
                const legend = L.control({
                    position: 'bottomright'
                });
                legend.onAdd = () => {
                    const div = L.DomUtil.create('div', 'info legend');
                    div.style.cssText = 'background:#fff;padding:8px;border:1px solid #ccc;border-radius:4px';
                    div.innerHTML = `
      <h6>Legenda</h6>
      <span style="display:inline-block;width:12px;height:12px;
                   background:#28a745;border-radius:50%;
                   margin-right:5px;"></span> Plot Area
    `;
                    return div;
                };
                legend.addTo(map);
            });
        </script>
    @endsection
