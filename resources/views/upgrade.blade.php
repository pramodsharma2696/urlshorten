<x-app-layout>
    <x-slot name="header"> 
    </x-slot>

    <div class="py-12">
       <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         
                       <h5>UPGRADE LIMIT</h5>
                       <p class="disabled">current Limit is : {{$limit->attempt_allowed}}</p>
                       <form action="{{ route('upgrade.update') }}" id="upgrade_form" method="post">
                        @csrf
                        <div class="mb-3 py-3">
                            <label for="url" class="form-label">Enter Url Shorten limit</label>
                            <input type="text" class="form-control" id="upgrade" name="upgrade" placeholder="Ex. 10, 20, 30...1000" required>
                        </div>
                        <button type="submit" id="BtnSave" class="btn btn-primary">Upgrade</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
       </div>
    </div>
</x-app-layout>
