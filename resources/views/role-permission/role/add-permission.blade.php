{{-- <x-app-web-layout> --}}
    <!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Role</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    </head>
      <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status')}}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h4>Role : {{$role->name}}
                                <a href="{{ url('roles')}}" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ url('roles/'.$role->id.'/give-permission') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    @error('permission')
                                        <span class="text-danger">{{ $message}}</span>
                                    @enderror

                                    <label for="">Permissions</label>

                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-2">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        name="permission[]"
                                                        value="{{ $permission->name }}"
                                                        {{ in_array($permission->id, $rolePermissions) ? 'checked':''}}>
                                                    </input>
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      </body>
</html>
{{-- </x-app-web-layout> --}}
