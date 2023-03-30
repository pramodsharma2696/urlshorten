<x-app-layout>
    <x-slot name="header"> 
    </x-slot>

    <div class="py-12">
       <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         @if(session('success'))
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                       <h5>EDIT URL</h5>
                       <form action="{{ route('url.update',$editdata->id) }}" id="edit_form" method="post">
                        @csrf
                        <div class="mb-3 py-3">
                            <label for="url" class="form-label">Edit Url to Shorten</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{$editdata->original_url}}">
                            @error('url')
                                {{$message}}
                                @enderror
                        </div>
                        <button type="submit" id="BtnSave" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
</x-app-layout>
