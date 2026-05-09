<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #ffffff; 
            font-family: 'Inter', -apple-system, sans-serif;
        }

        /* --- STYLE TABEL MODERN (Sesuai Permintaan) --- */
        .card {
            border: 1px solid #ececec;
            box-shadow: none !important; /* Menghilangkan shadow */
        }
        
        /* Menghilangkan garis tepi kiri dan kanan tabel */
        .table {
            border-left: none !important;
            border-right: none !important;
        }
        
        .table th, .table td {
            border-left: none !important;
            border-right: none !important;
            padding: 14px 12px;
            vertical-align: middle;
        }

        /* Header Tabel Modern & Ringan */
        .table thead th {
            background-color: #f8f9fa !important;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-top: 1px solid #dee2e6;
            border-bottom: 2px solid #f1f1f1 !important;
        }

        .badge {
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
        }
        /* Warna Badge Pastel */
        .bg-success { background-color: #d1e7dd !important; color: #0f5132 !important; }
        .bg-warning { background-color: #fff3cd !important; color: #664d03 !important; }
        .bg-danger { background-color: #f8d7da !important; color: #842029 !important; }
        
        code { color: #0d6efd; font-weight: bold; }
    </style>
</head>
<body>

<div class="container mt-5">
    <!-- Header Halaman -->
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h3 class="fw-bold mb-0">Sistem Rekap Pendaftaran Mahasiswa</h3>
            <p class="text-muted small mb-0">Manajemen data pendaftar baru</p>
        </div>
        <div>
            <button type="button" class="btn btn-outline-danger btn-sm px-3 me-2" onclick="resetData()">
                Reset Data
            </button>
            <button type="button" class="btn btn-primary btn-sm px-4" data-bs-toggle="modal" data-bs-target="#modalInput">
                Tambah Pendaftaran
            </button>
        </div>
    </div>

    <!-- Card Pembungkus Tabel (Tanpa Shadow) -->
    <div class="card border-0">
        <div class="table-responsive">
            <table class="table align-middle table-hover" id="tabelPendaftaran">
                <thead>
                    <tr class="text-center">
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>TTL</th>
                        <th>JK</th>
                        <th>Ortu</th>
                        <th>Tempat Tes</th>
                        <th>Bulan Tes</th>
                        <th>MTK</th>
                        <th>B.Ing</th>
                        <th>Umum</th>
                        <th>Rata-rata</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tbodyMahasiswa">
                    <tr>
                        <td colspan="12" class="text-center py-5 text-muted">
                            Belum ada data. Silakan input melalui tombol Tambah.
                        </td>
                    </tr>
                </tbody>
                <tfoot id="tfootStatistik" class="d-none border-top-0">
                    <!-- Statistik via JS -->
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal Input (Tetap menggunakan struktur Code Anda) -->
<div class="modal fade" id="modalInput" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Input Data Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 w-25">
                    <label class="form-label font-weight-bold small text-muted">Jumlah Input Data</label>
                    <select id="jumlah_input" class="form-select" onchange="generateFields()">
                        <option value="1">1 Data</option>
                        <option value="2">2 Data</option>
                        <option value="3">3 Data</option>
                        <option value="5">5 Data</option>
                        <option value="10">10 Data</option>
                    </select>
                </div>
                <hr>
                <div id="container-inputs">
                    <!-- Form dinamis -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success px-4" onclick="prosesPendaftaran()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer text-center small" 
        style="position: fixed; bottom: 0; left: 0; width: 100%; background: #f8f9fa; padding: 10px 20px; font-size: 12px; text-align: left;">
    Copyright &copy; 2026 powered with ❤️ by @zakaria
</footer>

<script>
function resetData() {
    if (confirm('Apakah Anda yakin ingin menghapus semua data pendaftaran?')) {
        const tbody = document.getElementById('tbodyMahasiswa');
        const tfoot = document.getElementById('tfootStatistik');
        tbody.innerHTML = `<tr><td colspan="12" class="text-center py-5 text-muted">Belum ada data. Silakan input melalui tombol Tambah.</td></tr>`;
        tfoot.classList.add('d-none');
        document.getElementById('jumlah_input').value = 1;
        generateFields();
    }
}

function generateFields() {
    const jumlah = document.getElementById('jumlah_input').value;
    const container = document.getElementById('container-inputs');
    container.innerHTML = '';

    for (let i = 0; i < jumlah; i++) {
        container.innerHTML += `
            <div class="row border mb-3 p-3 bg-light rounded item-pendaftaran">
                <h6 class="text-primary fw-bold">Data Calon Mahasiswa #${i+1}</h6>
                <div class="col-md-3 mb-2"><label class="small">Nama</label><input type="text" class="form-control inp-nama" required></div>
                <div class="col-md-3 mb-2">
                    <label class="small">Jenis Kelamin</label>
                    <select class="form-select inp-jk">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2"><label class="small">Tempat Lahir</label><input type="text" class="form-control inp-tempat" required></div>
                <div class="col-md-3 mb-2"><label class="small">Tanggal Lahir</label><input type="date" class="form-control inp-tgl-lahir" required></div>
                <div class="col-md-3 mb-2"><label class="small">Asal Sekolah</label><input type="text" class="form-control inp-sekolah" required></div>
                <div class="col-md-3 mb-2">
                    <label class="small">Pekerjaan Ortu</label>
                    <select class="form-select inp-ortu">
                        <option value="PNS">PNS</option>
                        <option value="Swasta">Swasta</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Buruh">Buruh</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="small">Tempat Tes</label>
                    <select class="form-select inp-tempat-tes">
                        <option value="A">Gedung A</option>
                        <option value="B">Gedung B</option>
                        <option value="V">Victor</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="small">Gelombang</label>
                    <select class="form-select inp-gel">
                        <option value="1">Gelombang 1</option>
                        <option value="2">Gelombang 2</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2"><label class="small">Tanggal Tes</label><input type="date" class="form-control inp-tgl-tes" required></div>
                <div class="col-md-3 mb-2"><label class="small">MTK</label><input type="number" class="form-control inp-mtk" max="100"></div>
                <div class="col-md-3 mb-2"><label class="small">B.Inggris</label><input type="number" class="form-control inp-bing" max="100"></div>
                <div class="col-md-3 mb-2"><label class="small">Umum</label><input type="number" class="form-control inp-umum" max="100"></div>
            </div>
        `;
    }
}

function prosesPendaftaran() {
    const items = document.querySelectorAll('.item-pendaftaran');
    const tbody = document.getElementById('tbodyMahasiswa');
    const tfoot = document.getElementById('tfootStatistik');
    
    let htmlContent = '';
    let stats = { total: 0, lulus: 0, cadangan: 0, tidak: 0 };

    items.forEach(item => {
        const nama = item.querySelector('.inp-nama').value;
        const jk = item.querySelector('.inp-jk').value;
        const tempatLahir = item.querySelector('.inp-tempat').value;
        const tglLahir = item.querySelector('.inp-tgl-lahir').value;
        const ortu = item.querySelector('.inp-ortu').value;
        const tptTes = item.querySelector('.inp-tempat-tes').value;
        const gel = item.querySelector('.inp-gel').value;
        const tglTes = item.querySelector('.inp-tgl-tes').value;
        const mtk = parseFloat(item.querySelector('.inp-mtk').value) || 0;
        const bing = parseFloat(item.querySelector('.inp-bing').value) || 0;
        const umum = parseFloat(item.querySelector('.inp-umum').value) || 0;

        const dtTes = new Date(tglTes);
        const bulan = tglTes ? dtTes.getMonth() + 1 : 0;
        const acak = Math.floor(100 + Math.random() * 900);
        const kode = `${tptTes}${gel}-${acak}-${bulan}`;

        const rata = (mtk + bing + umum) / 3;
        let ket = '', badge = '';

        if (rata > 70) { ket = 'Lulus'; badge = 'bg-success'; stats.lulus++; } 
        else if (rata >= 60) { ket = 'Cadangan'; badge = 'bg-warning'; stats.cadangan++; } 
        else { ket = 'Tidak Lulus'; badge = 'bg-danger'; stats.tidak++; }
        stats.total++;

        const namaGedung = tptTes === 'A' ? 'Gedung A' : (tptTes === 'B' ? 'Gedung B' : 'Victor');
        const namaBulan = tglTes ? dtTes.toLocaleString('id-ID', { month: 'short' }) : '-';

        htmlContent += `
            <tr class="text-center">
                <td><code>${kode}</code></td>
                <td class="text-start">${nama}</td>
                <td><small>${tempatLahir}, ${tglLahir}</small></td>
                <td>${jk}</td>
                <td>${ortu}</td>
                <td>${namaGedung}</td>
                <td>${namaBulan}</td>
                <td>${mtk}</td>
                <td>${bing}</td>
                <td>${umum}</td>
                <td><strong>${rata.toFixed(1)}</strong></td>
                <td><span class="badge ${badge}">${ket}</span></td>
            </tr>
        `;
    });

    tbody.innerHTML = htmlContent;
    tfoot.classList.remove('d-none');
    tfoot.innerHTML = `
        <tr class="border-top"><th colspan="10" class="text-end text-muted small">Jumlah Pendaftar</th><th colspan="2" class="text-center text-dark">${stats.total} Orang</th></tr>
        <tr><th colspan="10" class="text-end text-muted small">Jumlah Lulus</th><th colspan="2" class="text-center text-success">${stats.lulus} Orang</th></tr>
        <tr><th colspan="10" class="text-end text-muted small">Jumlah Tidak Lulus</th><th colspan="2" class="text-center text-danger">${stats.tidak} Orang</th></tr>
    `;

    bootstrap.Modal.getInstance(document.getElementById('modalInput')).hide();
}

window.onload = generateFields;
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>