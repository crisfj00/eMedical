@extends('layouts.app')

@section('template_title')
    Patient
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Patient') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Email</th>
										<th>Id Number</th>
										<th>Healthcare Number</th>
										<th>Birthday</th>
										<th>Occupation</th>
										<th>Address</th>
										<th>Phone Number</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $patient->email }}</td>
											<td>{{ $patient->id }}</td>
											<td>{{ $patient->healthcare_number }}</td>
											<td>{{ $patient->birthday }}</td>
											<td>{{ $patient->occupation }}</td>
											<td>{{ $patient->address }}</td>
											<td>{{ $patient->phone_number }}</td>

                                            <td>
                                                    <a class="btn btn-sm btn-primary " href="{{ route('patients.show',$patient->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $patients->links() !!}
            </div>
        </div>
    </div>
@endsection
