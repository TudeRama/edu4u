<div>
    <div class="container">
        @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </div>
        </div>
        @endif
        @if (session()->has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
        @endif
        <div class="mt-5">
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add data
                </button>

                <div class="pt-3 pb-3">
                    <input type="text" class="form-control w-25" placeholder="Search..." wire:model.live="kataKunci">
                </div>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">NO</th>
                    <th scope="col">NAMA BUKU</th>
                    <th scope="col">PENULIS</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">GAMBAR</th>
                    <th scope="col">FILE</th>
                    <th scope="col">AKSI</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                <tr>
                  <th>{{ $loop->iteration }}</th>
                  <th>{{ $item->nama }}</th>
                  <th>{{ $item->author }}</th>
                  <th>{{ $item->deskripsi }}</th>
                  <th><img src="{{ asset('storage/'. $item->gambar) }}" alt="" style="width: 100px;"></th>
                  <th><iframe src="{{ asset('storage/'. $item->file) }}" frameborder="0"></iframe></th>
                  <th>
                    <button type="button" class=" text-black" wire:click="edit({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#updateExampleModal"> <i class="fa-regular fa-pen-to-square" style="color: #886959;"></i></button>
                    <button type="button" class="text-black" wire:click="delConfirm({{ $item->id }})" data-bs-toggle="modal" data-bs-target="#deleteExampleModal"><i class="fa-solid fa-trash" style="color: #886959;"></i></button>
                  </th>
                </tr>
                @endforeach
                </tbody>
                {{ $data->links() }}
              </table>
        </div>
        {{-- Modal create --}}
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Add Data</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" wire:model="nama">

                      </div>
                      <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" wire:model="author">
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" wire:model="deskripsi">
                      </div>
                      <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select form-select-sm" id="kategori" wire:model="kategori_id">
                          <option selected>Open this select menu</option>
                          @foreach ($data2 as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" wire:model="gambar">
                      </div>
                      <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" wire:model="file">
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="storeData" >Save</button>
                </div>
                </form>
              </div>
            </div>
        </div>

        {{-- Modal Update --}}
        <div wire:ignore.self class="modal fade" id="updateExampleModal" tabindex="-1" aria-labelledby="updateExampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="updateExampleModalLabel">Update Data</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" wire:model="nama">

                      </div>
                      <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" wire:model="author">
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" wire:model="deskripsi">
                      </div>
                      <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select form-select-sm" id="kategori" wire:model="kategori_id">
                          <option selected>Open this select menu</option>
                          @foreach ($data2 as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambar" wire:model="gambar">
                      </div>
                      <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" wire:model="file">
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="updateData" >Update</button>
                </div>
                </form>
              </div>
            </div>
        </div>
{{-- Modal Delete --}}
        <div wire:ignore.self class="modal fade" id="deleteExampleModal" tabindex="-1" aria-labelledby="deleteExampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="deleteExampleModalLabel">Konfirmasi Delete Data</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                  <button wire:click="delete()" type="button" data-bs-dismiss="modal" class="btn btn-primary">Ya</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
