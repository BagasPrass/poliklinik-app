<x-layouts.app title="Data Dokter">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- Flash Message --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type', 'success') }} alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 fw-bold text-primary mb-0">
                        <i class="fas fa-user-md me-2"></i>Data Dokter
                    </h1>
                    <a href="{{ route('dokter.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Dokter
                    </a>
                </div>

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom text-center">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama Dokter</th>
                                        <th>Email</th>
                                        <th>No KTP</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Poli</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dokters as $index => $dokter)
                                        <tr>
                                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                            <td>
                                                <i class="text-secondary me-2"></i>{{ $dokter->nama }}
                                            </td>
                                            <td>{{ $dokter->email ?? '-' }}</td>
                                            <td>{{ $dokter->no_ktp ?? '-' }}</td>
                                            <td>{{ $dokter->no_hp ?? '-' }}</td>
                                            <td>{{ $dokter->alamat ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge rounded-pill bg-info-subtle text-info px-3 py-2">
                                                    {{ $dokter->poli->nama_poli ?? 'Belum Dipilih' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning shadow-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm"
                                                            onclick="return confirm('Yakin ingin menghapus dokter ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                <i class="fas fa-exclamation-circle me-2"></i>Belum ada data dokter.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
