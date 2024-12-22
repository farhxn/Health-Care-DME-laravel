@php
$sno = 1;
$userR = Session::get('LoginRole');
$editPer = Session::get('LoginEdit');
$deletePer = Session::get('LoginDelete');


// Preload all the related data to avoid querying in the loop
$doctorIds = $additionalPat->pluck('Off_Name')->filter()->unique();
$userIds = $additionalPat->pluck('User')->filter()->unique();
$deptIds = $additionalPat->pluck('Dept')->filter()->unique();
$statusIds = $additionalPat->pluck('Order_Status')->filter()->unique();

$doctors = \App\Models\Doctors::whereIn('id', $doctorIds)->pluck('Office_Name', 'id');
$users = \App\Models\Users::whereIn('id', $userIds)->pluck('name', 'id');
$departments = \App\Models\Departments::whereIn('id', $deptIds)->pluck('Department', 'id');
$statuses = \App\Models\Status::whereIn('id', $statusIds)->pluck('Status', 'id');
@endphp


@foreach ($additionalPat as $pt)
@php
$drName = $doctors->get($pt?->Off_Name);
$userName = $users->get($pt?->User);
$deptName = $departments->get($pt?->Dept);
$statusName = $statuses->get($pt?->Order_Status);



$listedText = $pt->Item;
$wordArray = explode(' ', $listedText);
if(count($wordArray) > 8) {
$trimmedText = implode(' ', array_slice($wordArray, 0, 10)) . '...';
} elseif(strlen($listedText) > 8 && !str_contains($listedText, ' ')) {
$trimmedText = substr($listedText, 0, 5) . '...';
} else {
$trimmedText = $listedText;
}
@endphp

<tr onclick="rowClickHandler(event, '/PatientDetail/{{ $pt->id }}');" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $pt->name }}'s Details">
    <td>{{ $pt->id }}</td>
    <td>{{ $pt->name }}</td>
    <td>{{ $pt->last_Name }}</td>
    <td>
        {{ $trimmedText }}
    </td>
    <td>{{ $pt->Dob }}</td>
    <td>{{ $drName }}</td>
    <td>{{ $pt->listed }}</td>
    <td>{{ $deptName }}</td>
    <td>{{ $userName }}</td>

    <td>{{ $statusName }}
    </td>

    <td>{{ $pt->created_at->format('m/d/Y h:i:s A') }}</td>
    <td class="text-center">
        @if($userR =="2" || $editPer == "on" || $userR == "1" || $deletePer =="on")
        <a href="{{ url('EditPatient', $pt->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit {{ $pt->name }}'s Details"><i class="fa fa-pen-to-square"></i></a>
        @endif
        @if($userR =="2" || $deletePer =="on" )
        <button data-url="{{ url('DeletePatient', $pt->id) }}" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete {{ $pt->name }} "><i class="fa fa-trash"></i></button>
        @endif
    </td>
</tr>
@endforeach
