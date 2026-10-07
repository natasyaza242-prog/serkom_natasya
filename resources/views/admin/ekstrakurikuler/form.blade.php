@extends('layouts.app')

@section('title', 'Ekstrakurikuler')

@section('content')
  <!-- Main Right Content -->
  <main style="flex: 1; display: flex; flex-direction: column;">

    <!-- Content Area -->
    <div style="padding: 32px 48px; max-width: 1000px;">
      
      <div>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
          {{ isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler' }}
        </h1>
        <p class="text-sm text-slate-500 mt-0.5">
          {{ isset($ekstrakurikuler) ? 'Perbarui data kegiatan ekstrakurikuler' : 'Tambah data kegiatan ekstrakurikuler baru' }}
        </p>
      </div>

      <!-- White Card Form -->
      <div style="background-color: #ffffff; border-radius: 16px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); padding: 36px 40px; margin-top: 24px;">
        
        @if ($errors->any())
          <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
            <ul style="margin: 0; padding-left: 20px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ isset($ekstrakurikuler) ? route('admin.ekstrakurikuler.save', Crypt::encrypt($ekstrakurikuler->id)) : route('admin.ekstrakurikuler.save') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              style="display: flex; flex-direction: column; gap: 24px;">
          @csrf
          
          <!-- Baris 1: Nama Ekstrakurikuler & Guru Pembina (2 Kolom) -->
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            
            <!-- Nama Ekstrakurikuler -->
            <div style="display: flex; flex-direction: column; gap: 8px;">
              <label for="nama_ekskul" style="font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 0.5px;">
                NAMA EKSTRAKURIKULER <span style="color: #ef4444;">*</span>
              </label>
              <input 
                type="text" 
                id="nama_ekskul" 
                name="nama_ekskul" 
                value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul ?? '') }}"
                placeholder="Contoh: Pramuka / Futsal" 
                required 
                style="width: 100%; box-sizing: border-box; padding: 12px 16px; font-size: 14px; border: 1px solid #e2e8f0; border-radius: 10px; background-color: #f8fafc; outline: none; color: #334155;"
              >
            </div>

            <!-- Guru Pembina -->
            <div style="display: flex; flex-direction: column; gap: 8px;">
              <label for="id_guru" style="font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 0.5px;">
                GURU PEMBINA <span style="color: #ef4444;">*</span>
              </label>
              <select 
                id="id_guru" 
                name="id_guru" 
                required 
                style="width: 100%; box-sizing: border-box; padding: 12px 16px; font-size: 14px; border: 1px solid #e2e8f0; border-radius: 10px; background-color: #f8fafc; outline: none; color: #334155;"
              >
                <option value="" disabled {{ old('id_guru', $ekstrakurikuler->id_guru ?? '') == '' ? 'selected' : '' }}>-- Pilih Guru Pembina --</option>
                @foreach($guru as $g)
                  <option value="{{ $g->id }}" {{ old('id_guru', $ekstrakurikuler->id_guru ?? '') == $g->id ? 'selected' : '' }}>
                    {{ $g->nama_guru ?? $g->nama }}
                  </option>
                @endforeach
              </select>
            </div>

          </div>

          <!-- Baris 2: Jadwal Latihan -->
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <label for="jadwal_latihan" style="font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 0.5px;">
              JADWAL LATIHAN <span style="color: #ef4444;">*</span>
            </label>
            <input 
              type="text" 
              id="jadwal_latihan" 
              name="jadwal_latihan" 
              value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan ?? '') }}"
              placeholder="Contoh: Jumat, 15.00 - 17.00" 
              required 
              style="width: 100%; box-sizing: border-box; padding: 12px 16px; font-size: 14px; border: 1px solid #e2e8f0; border-radius: 10px; background-color: #f8fafc; outline: none; color: #334155;"
            >
          </div>

          <!-- Baris 3: Gambar / Logo Ekskul (Dashed Upload Box) -->
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <label style="font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 0.5px;">
              GAMBAR / LOGO EKSKUL
            </label>
            
            <div 
              onclick="document.getElementById('gambar').click()"
              style="border: 1.5px dashed #10b981; border-radius: 12px; padding: 32px 20px; text-align: center; background-color: #ffffff; cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; transition: background-color 0.2s;"
            >
              @if(isset($ekstrakurikuler) && $ekstrakurikuler->gambar)
                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="Preview" style="height: 80px; width: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;">
              @else
                <!-- Green Upload Icon Circle -->
                <div style="width: 44px; height: 44px; background-color: #34d399; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #ffffff;">
                  <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                  </svg>
                </div>
              @endif
              
              <div style="font-size: 14px; font-weight: 600; color: #10b981;" id="upload_text">
                {{ isset($ekstrakurikuler) && $ekstrakurikuler->gambar ? 'Ganti logo ekstrakurikuler' : 'Pilih / Upload logo ekstrakurikuler' }}
              </div>
              <div style="font-size: 12px; color: #94a3b8;">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</div>
              
              <input 
                type="file" 
                id="gambar" 
                name="gambar" 
                accept="image/*" 
                style="display: none;"
                onchange="if(this.files.length) document.getElementById('upload_text').innerText = this.files[0].name;"
              >
            </div>
          </div>

          <!-- Baris 4: Deskripsi Ekskul -->
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <label for="deskripsi" style="font-size: 11px; font-weight: 700; color: #475569; letter-spacing: 0.5px;">
              DESKRIPSI EKSKUL
            </label>
            <textarea 
              id="deskripsi" 
              name="deskripsi" 
              rows="5" 
              placeholder="Tuliskan deskripsi singkat mengenai kegiatan ekstrakurikuler ini..." 
              style="width: 100%; box-sizing: border-box; padding: 14px 16px; font-size: 14px; border: 1px solid #e2e8f0; border-radius: 10px; background-color: #f8fafc; outline: none; color: #334155; resize: vertical;"
            >{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
          </div>

          <!-- Baris 5: Tombol Aksi (Kanan Bawah) -->
          <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-top: 12px;">
            <a 
              href="{{ route('admin.ekstrakurikuler.index') }}" 
              style="padding: 10px 24px; background-color: #f1f5f9; color: #475569; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 600; display: inline-block;"
            >
              Batal
            </a>
            <button 
              type="submit" 
              style="padding: 10px 20px; background-color: #031b11; color: #ffffff; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;"
            >
              <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
              </svg>
              Simpan Data Ekskul
            </button>
          </div>

        </form>

      </div>
    </div>
  </main>
@endsection