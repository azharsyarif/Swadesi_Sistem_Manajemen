@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Create Leave Request</h1>

    <form action="{{ route('pengajuan-izin-sakit.store') }}" method="POST" enctype="multipart/form-data" id="izinForm">
        @csrf

        <div class="form-group">
            <label for="jenis">Pilih Jenis Izin</label>
            <select name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                <option value="" disabled selected>Pilih Jenis Izin</option>
                <option value="izin" {{ old('jenis') == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ old('jenis') == 'sakit' ? 'selected' : '' }}>Sakit</option>
            </select>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div id="izinFormContainer" style="display: none;">
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                @error('tanggal_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required>
                @error('tanggal_akhir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alasan">Alasan</label>
                <textarea class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" rows="3" required>{{ old('alasan') }}</textarea>
                @error('alasan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="jatahCutiField" style="display: none;">
                <label for="jatah_cuti">Jatah Cuti Saat Ini: <span id="jatahCutiValue">{{ isset($user) ? $user->jatah_cuti : '-' }}</span></label>
            </div>

            <div class="form-group" id="buktiDokumenField" style="display: none;">
                <label for="bukti_dokumen">Bukti Dokumen (opsional)</label>
                <input type="file" class="form-control-file @error('bukti_dokumen') is-invalid @enderror" id="bukti_dokumen" name="bukti_dokumen">
                @error('bukti_dokumen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Ajukan Izin Sakit</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#jenis').change(function() {
            var jenis = $(this).val();
            if (!jenis) {
                $('#izinFormContainer').hide();
            } else {
                $('#izinFormContainer').show();
                if (jenis === 'izin') {
                    $('#jatahCutiField').show();
                    $('#buktiDokumenField').hide();
                } else if (jenis === 'sakit') {
                    $('#jatahCutiField').hide();
                    checkAndShowBuktiDokumen();
                }
            }
        });

        $('#tanggal_mulai, #tanggal_akhir').change(function() {
            checkAndShowBuktiDokumen();
        });

        function checkAndShowBuktiDokumen() {
            var jenis = $('#jenis').val();
            var tanggalMulai = $('#tanggal_mulai').val();
            var tanggalAkhir = $('#tanggal_akhir').val();

            if (jenis === 'sakit') {
                var diffInMs = new Date(tanggalAkhir) - new Date(tanggalMulai);
                var diffInDays = diffInMs / (1000 * 60 * 60 * 24);

                if (diffInDays >= 3) {
                    $('#buktiDokumenField').show();
                } else {
                    $('#buktiDokumenField').hide();
                }
            }
        }

        // Trigger change event on jenis on page load
        $('#jenis').change();
    });
</script>
@endsection
