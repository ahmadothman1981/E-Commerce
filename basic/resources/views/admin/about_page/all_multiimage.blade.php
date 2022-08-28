@extends('admin.admin_master')
@section('admin')

 

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Multi Images All</h4>

                                   

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Multi Images All</h4>
                                       
        
    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
            <th>Serial Number</th>
            <th>About Multi Image</th>
            <th>Action</th>
            
        </tr>
        </thead>


        <tbody>
        	@php($i=1)
        	@foreach($allMultiImage as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td><img src="{{ asset($item->multi_image) }}" style="width: 60px; height=60px;" ></td>
            <td><a href="" class="btn btn-info" title="Edite Data"><i class="fas fa-edit"></i> </a>
             <a href="" class="btn btn-danger" title="Delete Data"><i class="fas fa-trash-alt"></i> </a></td>
            
        </tr>
       		@endforeach
        </tbody>
    </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                        
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                
                
            </div>


@endsection