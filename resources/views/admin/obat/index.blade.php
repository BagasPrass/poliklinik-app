<x-layouts.app title="Data Obat">
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
                        <i class="fas fa-pills me-2"></i>Data Obat
                    </h1>
                    <a href="{{ route('obat.create') }}" class="btn btn-primary shadow-sm">
                        <i class="fas fa-plus me-1"></i> Tambah Obat
                    </a>
                </div>

                <div class="card shadow border-0 rounded-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom text-center">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Nama Obat</th>
                                        <th>Kemasan</th>
                                        <th>Harga</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($obats as $index => $obat)
                                        <tr>
                                            <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                            <td>
                                                <i class="text-secondary me-2"></i>{{ $obat->nama_obat }}
                                            </td>
                                            <td>{{ $obat->kemasan ?? '-' }}</td>
                                            <td>Rp {{ number_format($obat->harga ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning shadow-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm"
                                                            onclick="return confirm('Yakin ingin menghapus obat ini?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="fas fa-exclamation-circle me-2"></i>Belum ada data obat.
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
