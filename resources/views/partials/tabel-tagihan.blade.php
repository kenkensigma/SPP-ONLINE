@php use Illuminate\Support\Facades\Auth; @endphp
<h3>{{ $kelas }}</h3>

<link rel="stylesheet" href="{{ asset('css/tagihan.css') }}">

@if ($siswa->isEmpty())
    <p style="text-align: center; color: #666;">Data invalid atau belum ada siswa di kelas ini.</p>
@else
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Jenis Biaya</th>
                    <th>Total Tagihan</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($siswa as $s)
                    @foreach ($s->tagihan as $tagih)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $tagih->jenis_biaya }}</td>
                            <td>{{ $tagih->total_tagihan }}</td>
                            <td style="color: {{ $tagih->status === 'Lunas' ? 'green' : 'red' }};">
                                {{ $tagih->status }}
                            </td>

                            <td>{{ $tagih->created_at->format('d M Y') }}</td>
                            <td>
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('kelas.edit', $s->id) }}" class="btn-edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('kelas.destroy', $s->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endif
