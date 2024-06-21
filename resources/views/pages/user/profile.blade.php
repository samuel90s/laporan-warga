@extends('layouts.app')

@section('content')
    <main id="main" class="martop">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Profil') }}</div>

                        <div class="card-body">
                            @if (session('pesan'))
                                <div class="alert alert-{{ session('type') }}">
                                    {{ session('pesan') }}
                                </div>
                            @endif

                            <form action="{{ route('user.updateProfile') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $masyarakat->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $masyarakat->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ old('username', $masyarakat->username) }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="laki-laki"
                                            {{ $masyarakat->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="perempuan"
                                            {{ $masyarakat->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="telp" class="form-label">Telepon</label>
                                    <input type="text" name="telp" class="form-control"
                                        value="{{ old('telp', $masyarakat->telp) }}">
                                    @error('telp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control">{{ old('alamat', $masyarakat->alamat) }}</textarea>
                                    @error('alamat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="rt" class="form-label">RT</label>
                                        <input type="text" name="rt" class="form-control"
                                            value="{{ old('rt', $masyarakat->rt) }}">
                                        @error('rt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="rw" class="form-label">RW</label>
                                        <input type="text" name="rw" class="form-control"
                                            value="{{ old('rw', $masyarakat->rw) }}">
                                        @error('rw')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
