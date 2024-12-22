<?php
namespace App\Models;

use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    public static function fetchPatients($userId, $userView)
    {
        $userR = Session::get('LoginRole');
        $userC = Session::get('LoginCancel');
        $userd = Session::get('LoginDept');

        // Ensure $userd is decoded properly
        $deptIds = json_decode($userd, true);
        if (!is_array($deptIds)) {
            $deptIds = [];
        }

        // Determine the query based on user role
        if ($userR == "0") {
            // If user role is 0, filter by department and user
            $query = self::whereIn('Dept', $deptIds)
                         ->select('request','Order_Status','resupplyDate','updated_at','Dept')
                         ->where('User', $userId)
                         ->orderBy('created_at', 'desc');
        } else {
            // If user role is not 0, fetch all patients
            $query = self::select('request','Order_Status','resupplyDate','updated_at','Dept')->orderBy('created_at', 'desc');
        }

        $drs = $query->get();
        $pt = $drs->count();
        $st = Status::select('Status','id','order')->orderBy('order', 'asc')->get();

        $userMailPer = Session::get('LoginMailPermission');
        $sessionTypes = ["New Patient Added", "Patient Status Change", "Patient Department Change", "Patient Status Change", "New Document Added", "Doctor Added", "Doctor Edit", "Doctor Deleted", "User Added", "User Deleted", "User Editeded", "Document Edited", "Document Deleted", "Authentication", "Document Edited", "User Banned", "User Password Changed", "Document Edited", "Patient Edited", "Patient Deleted"];
        $permissionValues = json_decode($userMailPer, true);

        $noti = Notifications::where(function ($query) use ($sessionTypes, $permissionValues, $userId, $userR) {
                 $query->whereIn('type', $sessionTypes)
                       ->when(!empty($permissionValues), function ($query) use ($permissionValues) {
                           foreach ($permissionValues as $value) {
                               $query->orWhere('type', $value);
                           }
                       });

                 if ($userR == "0") {
                     $query->orWhere('UserId', $userId);
                 }
             })
             ->orderBy('created_at', 'desc')
             ->select('Message','UploadedBy','created_at')
             ->limit(3)
             ->get();

        return compact('drs', 'pt', 'st', 'noti');
    }
}

