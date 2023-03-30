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
                       <h5>URL SHORTNER</h5>
                       <form id="addurl_form" method="post" action="{{ route('shorten.store') }}">
                        @csrf
                        <div class="mb-3 py-3">
                            <label for="url" class="form-label">Enter Url to Shorten</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="https://example.com/">
                                @error('url')
                                {{$message}}
                                @enderror
                        </div>
                        <button type="submit" id="BtnSave" class="btn btn-primary">Submit</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
</x-app-layout>
