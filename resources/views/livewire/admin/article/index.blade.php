<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div>
            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Article Delete</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent="destroyArticle">
                            <div class="modal-body">
                                <h6>Are you sure to delete data?</h6>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- @if (session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif --}}

                <div class="card">
                    <div class="card-header">
                        <h3>Article
                            <a href="{{ route('create.article')}}" class="btn btn-primary btn-sm float-end">New Article</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        {{-- List --}}
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <body>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->name }}</td>
                                        <td>{{ $article->category }}</td>
                                        <td>{{ $article->status == '1' ? 'Inactive':'Active' }}</td>
                                        <td>
                                            <a href="{{ url('admin/article/'.$article->id.'/edit')}}" class="btn btn-success">Edit</a>
                                            <a href="#" wire:click="deleteArticle({{$article->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </body>
                        </table>
                        <div>
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')

<script>
    window.addEventListener('close-modal', event => {
        $('#deleteModal').modal('hide');
    });

    // window.addEventListener('livewire:load', function () {
    //     Livewire.on('close-modal', () => {
    //         $('#deleteModal').modal('hide');
    //     });
    // });
</script>

@endpush
