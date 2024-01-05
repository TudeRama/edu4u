<div>
    <button class="fs-3 text-primary" wire:click="like({{ $article->id }})"><i class="fa-solid fa-thumbs-up"></i>({{ $article->totalLike() }})</button>

    <h3 class="h3 text-black">({{ $total_comment }}) Comment</h3>

    <form wire:submit.prevent="store" class="mb-4">
            <textarea wire:model="body" rows="2" class="form-control @error('body') is-invalid @enderror" placeholder="tulis komentar anda" ></textarea>
            @error('body')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="mt-3 d-grid">
                <button class="btn btn-primary">Kirim</button>
            </div>

    </form>

    @foreach ($comment as $item)
    <div class="mb-3">
        <div class="d-flex align-items-start">

            <img src="https://i.pinimg.com/236x/56/2e/be/562ebed9cd49b9a09baa35eddfe86b00.jpg" alt="" class="img-fluid rounded-circle me-3" width="40" height="40">
            <div>
                <div>
                    <span>{{ $item->user->name }}</span>
                    <span>{{ $item->created_at }}</span>
                </div>
                <div>
                    {{ $item->body }}
                </div>
                <div>
                    <button class="btn btn-primary" wire:click ="selectReply({{ $item->id }})">Balas</button>
                    @if ($item->user_id == Auth::user()->id)
                    <button class="btn btn-warning" wire:click="selectEdit({{ $item->id }})">Edit</button>
                    <button class="btn btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                    @endif
                    @if ($edit_comment_id == $item->id)
                    <form wire:submit.prevent="update" class="mb-4 mt-3">
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="tulis komentar anda" ></textarea>
                        @error('body2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-3 d-grid">
                            <button class="btn btn-warning">Update</button>
                        </div>
                    </form>
                    @endif
                    @if ($comment_id == $item->id)
                    <form wire:submit.prevent="reply" class="mb-4 mt-3">
                        <textarea wire:model.defer="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="tulis komentar anda" ></textarea>
                        @error('body2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-3 d-grid">
                            <button class="btn btn-warning">Reply</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @if ($item->children)
        @foreach ($item->children as $item2)
        <div class="d-flex align-items-start ml-4">
            <img src="https://i.pinimg.com/236x/56/2e/be/562ebed9cd49b9a09baa35eddfe86b00.jpg" alt="" class="img-fluid rounded-circle me-3" width="40" height="40">
            <div>
                <div>
                    <span>{{ $item2->user->name }}</span>
                    <span>{{ $item2->created_at }}</span>
                </div>
                <div>
                    {{ $item2->body }}
                </div>
                <div>
                    <button class="btn btn-primary" wire:click ="selectReply({{ $item2->id }})">Balas</button>
                    @if ($item2->user_id == Auth::user()->id)
                    <button class="btn btn-warning" wire:click="selectEdit({{ $item2->id }})">Edit</button>
                    <button class="btn btn-danger" wire:click="delete({{ $item2->id }})">Hapus</button>
                    @endif
                    @if ($edit_comment_id == $item2->id)
                    <form wire:submit.prevent="update" class="mb-4 mt-3">
                        <textarea wire:model="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="tulis komentar anda" ></textarea>
                        @error('body2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-3 d-grid">
                            <button class="btn btn-warning">Update</button>
                        </div>
                    </form>
                    @endif
                    @if ($comment_id == $item2->id)
                    <form wire:submit.prevent="reply" class="mb-4 mt-3">
                        <textarea wire:model="body2" rows="2" class="form-control @error('body2') is-invalid @enderror" placeholder="tulis komentar anda" ></textarea>
                        @error('body2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-3 d-grid">
                            <button class="btn btn-warning">Reply</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @endif
        <hr>
    </div>
    @endforeach
</div>
