@if(count($siswaList) === 0)
    <p style="text-align: center;">Data tidak ditemukan.</p>
@endif

@foreach($siswaList as $siswa)
    @php
        $tagihanSemester1 = \App\Models\TagihanSiswa::where('siswa_id', $siswa->id)->where('semester', 1)->sum('jumlah');
        $tagihanSemester2 = \App\Models\TagihanSiswa::where('siswa_id', $siswa->id)->where('semester', 2)->sum('jumlah');
    @endphp

    <div class="card blue">
        <strong>{{ $siswa->nama }}</strong>
        <div class="card-content">
            <p>NIS: {{ $siswa->nis }}</p>
            <p>Kelas: {{ $siswa->kelas->nama_kelas }}</p>
            <p>SPP Semester 1: Rp{{ number_format($tagihanSemester1, 0, ',', '.') }}</p>
            <p>SPP Semester 2: Rp{{ number_format($tagihanSemester2, 0, ',', '.') }}</p>
        </div>
    </div>
@endforeach
