<!-- resources/views/explore_data.blade.php -->

@extends('layouts.app1')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row mt-3">
                <div class="col-6">
                    <form action="{{ route('import-csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <input class="form-control" type="file" id="csv_file" name="csv_file" accept=".csv"
                                required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Import CSV</button>
                            </div>
                        </div>
                    </form>
                  <form action="{{ route('export-csv') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Export to CSV</button>
</form>

                </div>
             

            </div>
          

            <hr>

                        </div>


            <!-- Import the contents of example.txt if it exists -->
            <div class="table-responsive datatable-custom">
                <table
                    class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                    data-hs-datatables-options='{
                          "scrollY": 300,
                          "paging": false,
                          "order": []
                         }'>
                    <thead class="thead-light">
            
                        <tr>
                            <th>ID</th>
                            <th>Output Freq</th>
                            <th>Input Freq</th>
                            <th>Offset</th>
                            <th>Uplink Tone</th>
                            <th>Downlink Tone</th>
                            <th>Location</th>
                            <th>County</th>
                            <th>Lat</th>
                            <th>Long</th>
                            <th>Call</th>
                            <th>Use</th>
                            <th>Op Status</th>
                            <th>Mode</th>
                            <th>Digital Access</th>
                            <th>EchoLink</th>
                            <th>IRLP</th>
                            <th>AllStar</th>
                            <th>Coverage</th>
                            <th>Status</th>
                            <th>type</th>
                            <th>Last_Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php
                            $uniqueLocations = []; // Create an array to store unique locations
                        @endphp --}}
                        @foreach ($exploreData as $index => $item)
                            {{-- @if (!in_array($item->Location, $uniqueLocations))
                                @php
                                    $uniqueLocations[] = $item->Location; // Add the location to the unique locations array
                                @endphp --}}
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->Output_Freq }}</td>
                                    <td>{{ $item->Input_Freq }}</td>
                                    <td>{{ $item->Offset }}</td>
                                    <td>{{ $item->Uplink_Tone }}</td>
                                    <td>{{ $item->Downlink_Tone }}</td>
                                    <td>{{ $item->Location }}</td>
                                    <td>{{ $item->County }}</td>
                                    <td>{{ $item->Lat }}</td>
                                    <td>{{ $item->Long }}</td>
                                    <td>{{ $item->Call }}</td>
                                    <td>{{ $item->Use }}</td>
                                    <td>{{ $item->Op_Status }}</td>
                                    <td>{{ $item->Mode }}</td>
                                    <td>{{ $item->Digital_Access }}</td>
                                    <td>{{ $item->EchoLink }}</td>
                                    <td>{{ $item->IRLP }}</td>
                                    <td>{{ $item->AllStar }}</td>
                                    <td>{{ $item->Coverage }}</td>
                                    <td>{{ $item->Status }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->Last_Update }}</td>
                                    <td>{{ isset($exampleRows[$index]) ? $exampleRows[$index] : '' }}</td>
                                </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <nav class="d-sm-flex justify-content-sm-between align-items-sm-center text-center"
                    aria-label="Page navigation example">
                    <ul class="pagination justify-content-center justify-content-sm-end">
                        {{ $exploreData->links() }}
                    </ul>
                    <small class="text-muted">Showing {{ $exploreData->firstItem() }} - {{ $exploreData->lastItem() }} of
                        {{ $exploreData->total() }}</small>
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </main>
@endsection
