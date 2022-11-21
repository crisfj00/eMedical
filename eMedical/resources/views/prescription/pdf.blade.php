<div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>

										<th>Patient Id</th>
										<th>Doctor Id</th>
										<th>Consultation</th>
                                        <th>Diagnosis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>                              
											<td>{{ $prescription->patient_id }}</td>
											<td>{{ $prescription->doctor_id }}</td>
											<td>{{ \Illuminate\Support\Str::limit($prescription->consultation, 30, $end='...') }}</td></td>
                                            <td>{{ \Illuminate\Support\Str::limit($prescription->diagnosis, 30, $end='...') }}</td></td>
                                        </tr>
                                </tbody>
                            </table>
</div>

                        </div>