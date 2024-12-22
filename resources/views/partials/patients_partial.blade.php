@php
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
    $trimmedText = count($wordArray) > 8 ? implode(' ', array_slice($wordArray, 0, 10)) . '...' : (strlen($listedText) > 10 && !str_contains($listedText, ' ') ? substr($listedText, 0, 5) . '...' : $listedText);
    @endphp

    <tr class="dynamic-rows" data-id="{{ $pt->id }}" data-toggle="tooltip" data-placement="top" title="Show {{ $pt->name }}'s Details" style="cursor: pointer;">
        <td>{{ $pt->id }}</td>
        <td>{{ $pt->name }}</td>
        <td>{{ $pt->last_Name }}</td>
        <td>{{ $trimmedText }}</td>
        <td>{{ $pt->Dob }}</td>
        <td>{{ $drName }}</td>
        <td>{{ $pt->listed }}</td>
        <td>{{ $deptName }}</td>
        <td>{{ $userName }}</td>
        <td>{{ $statusName }}</td>
        <td>{{ $pt->created_at->format('m/d/Y h:i:s A') }}</td>
    </tr>
@endforeach
