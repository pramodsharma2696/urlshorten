<x-app-layout>
    <x-slot name="header"> </x-slot>
    <div class="py-1">
       <div class="container">
        @if($userurllist)
        <div class="row py-5">
            <div class="row">
                <div class="col-sm-6">
                @if(session('success1'))
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success1') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                </div>
                <div class="col-sm-6">
                <a href="{{ route('shorten.view') }}" class="btn btn-primary float-end mb-2">Add Url to Shorten</a>

                </div>
            </div>
            <div class="col-sm-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">                        
                        <h5>SHORTEN URL LIST</h5>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col">Original Link</th>
                            <th scope="col">Shorten Link</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userurllist as $list)
                            <tr>
                            <td> {{ $userurllist->firstItem()+$loop->index }} </td>
                            @if($list->status == 0)
                            <td class="scroll">{{$list->original_url}} </td>
                            <td>{{$list->shorten_url}} <a href="{{ route('shorten.redirect',$list->shorten_url) }}" target="blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                             @else
                             <td class="scroll"><s>{{$list->original_url}}</s></td>
                            <td><s>{{$list->shorten_url}}</s></td>
                             @endif
                            <td>
                                <a href="{{ route('shorten.edit',$list->id) }}" class="btn btn-primary btn-sm editBtn"><i class="fa fa-edit"></i></a>
                                <a href="#" onClick="deleteUrl(`{{route('shorten.delete',$list->id)}}`,`{{$list->id}}`)" class="btn btn-danger btn-sm deleteBtn"><i class="fa fa-trash"></i></a>
                                @if($list->status == 0)
                                <a href="#" onClick="deactivateUrl(`{{route('shorten.deactivate',$list->id)}}`,`{{$list->id}}`)" class="btn btn-danger btn-sm deactivateBtn"><i class="fa fa-ban"></i></a>
                                @else
                                <a href="#" onClick="activateUrl(`{{route('shorten.activate',$list->id)}}`,`{{$list->id}}`)" class="btn btn-success btn-sm activateBtn"><i class="fa fa-check"></i></a>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $userurllist->links() }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
       </div>
    </div>
</x-app-layout>
