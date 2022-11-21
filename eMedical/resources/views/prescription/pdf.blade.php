<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        table, th, td {
        border:1px solid black;
        text-align: justify;
        }

        table{
            width: 100%;
            margin: 2% 0;
        }

        th{
            width:25%;

        }

        h4{
            margin-left:2%;
        }

        h6{
            padding-left:2%;
        }
    </style>
    </head>
<body>
        <h3>eMedical - Prescription ID #{{$data['prescription']->id}}</h3>
    <table>
        <tr>
        <th><h4 style="margin-right: 1em;">Patient Name: </h4></th><td><h6>{{$data['patient_user']['name']}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Id Number: </h4></th><td><h6>{{$data['prescription']->patient_id}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Helth Care Number: </h4></th><td><h6>{{$data['patient']->healthcare_number}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Birthday Date: </h4></th><td><h6>{{ \Carbon\Carbon::parse($data['patient']->birthday)->format('d/m/Y')}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Consultation Date: </h4></th><td><h6>{{ \Carbon\Carbon::parse($data['prescription']->created_at)->format('d/m/Y')}}</h6></td>
        </tr>
    </table>

    <table>
        <tr>
        <th><h4 style="margin-right: 1em;">Doctor Name: </h4></th><td><h6>{{$data['doctor_user']['name']}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Professional Number: </h4></th><td><h6>{{$data['prescription']->doctor_id}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Specialty: </h4></th><td><h6>{{$data['doctor']->specialty}}</h6></td>
        </tr>
        <tr>
        <th><h4 style="margin-right: 1em;">Prescription Date: </h4></th><td><h6>{{ \Carbon\Carbon::parse($data['prescription']->updated_at)->format('d/m/Y')}}</h6></td>
        </tr>
    </table>

    <div class="pres-info"
    style=" width:auto; 
                    display:flex;
                    flex-direction:column;
                    justify-content: space-between;
                    margin: 3% 0;">
    <h4>Consultation:</h4>
    <h6 style="text-align: justify;">{{ $data['prescription']->consultation }}</h6>
    <h4>Diagnosis:</h4>
    <h6 style="text-align: justify;">{{ $data['prescription']->diagnosis }}</h6>
    </div>
</body>
</html>