@extends('layouts.app1')

@section('content')
    <main id="content" role="main" class="main">
 <div class="card px-5 pt-3 rounded-0 ">
       


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

        <!-- Card -->
        <div class="card  ">
            <!-- Header -->
            <div class="card-header">
                <h4 class="card-header-title">Code Generator</h4> 
            </div>
            <!-- End Header -->

         

            <form method="POST" action="{{ route('license.store') }}">
                @csrf
        
                <div class="form-group">
                   
                    <input type="number" name="number_of_codes" id="number_of_codes" class="form-control" min="1" required>
                </div>
        
                <button type="submit" class="btn btn-primary">Generate Codes</button>
            </form>

        </div>
        <!-- End Card -->
        <!-- Update Plan Modal -->
      
        <!-- End Update Plan Modal -->
        <!-- Add Card Modal -->
     
      

      </div>
 <div class="card px-5 pt-3 rounded-0 ">
       




        <!-- Card -->
        <div class="card  my-3 ">
            <!-- Header -->
            <div class="card-header">
                <h4 class="card-header-title">Register code management</h4>
            </div>
            <!-- End Header -->

         <div class="table-responsive position-relative">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Dock ID</th>
                        <th>User ID</th>
                        <th>License Type</th>
                        <th>Storage Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($license_code as $license)
                    <tr>
                        <td>{{ $license->id }}</td>
                        <td>{{ $license->code }}@if ($license->bindwithdock)
                            {{-- {{ $license->bindwithdock->name }} --}}
                            <span class="badge bg-info rounded-pill ms-1">assigned</span>
                        @else
                        <span class="badge bg-danger rounded-pill ms-1">Unassigned</span>
                        @endif</td>
                        <td>{{ $license->status }}</td>
                        <td>{{ $license->bindwithdock->name ?? "Not found" }}</td>

                        <td>
                            {{ $license->user->name ?? "Not found" }}
                        </td>
                        
                        {{-- <td>{{ $license->license_type }}</td> --}}
                        <td>Basic</td>
                        <td>Basic</td>
                        {{-- <td>{{ $license->storage_type }}</td> --}}
                        <td>
                            {{-- <a href="{{ route('license.edit', $license->id) }}" class="btn btn-primary">Edit</a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $license_code->links() }}
        </div>

        </div>
        <!-- End Card -->
        <!-- Update Plan Modal -->
      
        <!-- End Update Plan Modal -->
        <!-- Add Card Modal -->
     
      

      </div>
    </main>
@endsection
