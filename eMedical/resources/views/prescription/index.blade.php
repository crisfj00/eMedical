@extends('layouts.app')

@section('template_title')
    Prescription
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Prescription') }}
                            </span>
                            @if(Auth::user()->isPatient())
                             <div class="float-right">
                                <a href="{{ route('prescriptions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                              @endif
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
										<th>Patient Id</th>
										<th>Doctor Id</th>
										<th>Consultation</th>
										<th>Created</th>
                                        <th>Responded</th>
										<th>State</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescriptions as $prescription)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $prescription->patient_id }}</td>
											<td>{{ $prescription->doctor_id }}</td>
											<td>{{ \Illuminate\Support\Str::limit($prescription->consultation, 30, $end='...') }}</td>
                                            <td>{{ $prescription->created_at }}</td>
											<td>@if( $prescription->state ) {{ $prescription->created_at }} @else  @endif</td>

											<td>@if( $prescription->state )SOLVED @else PENDING @endif</td>

                                            <td>
                                                <form action="{{ route('prescriptions.destroy',$prescription->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('prescriptions.show',$prescription->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    @if(Auth::user()->isDoctor() && !$prescription->state)
                                                    <a class="btn btn-sm btn-success" href="{{ route('prescriptions.edit',$prescription->id) }}"><i class="fa fa-fw fa-edit"></i> Respond</a>
                                                    @endif
                                                    @csrf
                                                    @if(Auth::user()->isPatient())
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $prescriptions->links() !!}
            </div>
        </div>
    </div>
@endsection
