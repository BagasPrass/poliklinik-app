<x-layouts.app title="Data Pasien">
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
                        <i class="fas fa-users me-2"></i>Data Pasien
                    </h1>
                    <a href="{{ route('pasien.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Pasien
                    </a>
                </div>

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom text-center">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama Pasien</th>
                                        <th>Email</th>
                                        <th>No KTP</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pasiens as $index => $pasien)
                                        <tr>
                                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                            <td>
                                                <i class="text-secondary me-2"></i>{{ $pasien->nama }}
                                            </td>
                                            <td>{{ $pasien->email ?? '-' }}</td>
                                            <td>{{ $pasien->no_ktp ?? '-' }}</td>
                                            <td>{{ $pasien->no_hp ?? '-' }}</td>
                                            <td>{{ $pasien->alamat ?? '-' }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-sm btn-warning shadow-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm"
                                                            onclick="return confirm('Yakin ingin menghapus pasien ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-exclamation-circle me-2"></i>Belum ada data pasien.
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
