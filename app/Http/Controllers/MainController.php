<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Copayment;
use App\Models\Departments;
use App\Models\Diagnosis;
use App\Models\Doctors;
use App\Models\documents;
use App\Models\History;
use App\Models\ICDNine;
use App\Models\ICDTen;
use App\Models\InsuranceCompany;
use App\Models\InsuranceType;
use App\Models\InvoiceForm;
use App\Models\Logs;
use App\Models\Notes;
use App\Models\Notifications;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\PatientInsurance;
use App\Models\Patients;
use App\Models\PreferredNotes;
use App\Models\PriceCode;
use App\Models\Status;
use App\Models\Users;
use App\Models\subDept;
use App\Models\Reminders;
use App\Models\Taxes;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Redirect;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class MainController extends Controller
{
    public function index(Request $request)
    {
        $userRole = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $departments = Departments::select('id', 'Department')->get();

        if ($userRole == "0") {
            $userDepartments = json_decode(FacadesSession::get('LoginDept'), true) ?? [];
            $order = Orders::where('AssignUser', $userId)->whereIn('Department', $userDepartments)->select('id', 'Patient_Name', 'Patient_Last_Name', 'Items', 'Patient_DOB', 'Account', 'created_at', 'CreatedBy', 'OrderStatus', 'Patient_ID', 'Department')->orderBy('created_at', 'desc')->get();

            // $patientsQuery = Patients::whereIn('Dept', $userDepartments)
            //     ->where('User', $userId)
            //     ->where('Order_Status', '!=', 17)
            //     ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
            //     ->orderBy('created_at', 'desc');
            // $patients = $patientsQuery->paginate(50);

            $viewOnlyDepartments = json_decode(FacadesSession::get('LoginViewDept'), true) ?? [];
            $viewPatients = Patients::whereIn('Department', $viewOnlyDepartments)
                ->where('User', $userId)
                ->select('Order_Status')
                ->get();
        } else {

            $order = Orders::select('id', 'Patient_Name', 'Patient_Last_Name', 'Items', 'Patient_DOB', 'Account', 'created_at', 'CreatedBy', 'OrderStatus', 'Patient_ID', 'Department')->orderBy('created_at', 'desc')->get();

            $viewPatients = Patients::select('Order_Status', 'Dept')->get();
        }
        $currentUser = Users::find($userId);
        return view('index', compact('drs', 'st', 'departments', 'pt', 'currentUser', 'order', 'viewPatients', 'noti'));
    }

    //Ajax Request

    public function patientPendingList()
    {
        try {
            $userR = FacadesSession::get('LoginRole');
            $userId = FacadesSession::get('LoginId');
            if ($userR == "0") {
                $userd = FacadesSession::get('LoginDept');
                $deptIds = json_decode($userd, true) ?? [];
                $query = Patients::whereIn('Dept', $deptIds)->where('User', $userId)
                    ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at');
                $additionalPat = $query->where('Order_Status', '!=', 17)->orderBy('created_at', 'desc')->skip(50)->take(PHP_INT_MAX)->get(); // Use pagination
            } else {
                $additionalPat = Patients::where('Order_Status', '!=', 17)->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')->orderBy('created_at', 'desc')->skip(50)->take(PHP_INT_MAX)->get(); // Use pagination
            }
            return view('partials.patients_partial', compact('additionalPat'))->render();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading additional patients.'], 500);
        }
    }


    public function patientStatusPendingList($id)
    {
        try {
            $userR = FacadesSession::get('LoginRole');
            $userId = FacadesSession::get('LoginId');
            $userView = FacadesSession::get('LoginViewCheck');
            if ($userR ==  "0") {
                $userd = FacadesSession::get('LoginDept');
                $deptIds = json_decode($userd, true) ?? [];

                $query = Patients::whereIn('Dept', $deptIds)
                    ->where('Order_Status', $id)
                    ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
                    ->orderBy('created_at', 'desc')
                    ->where('User', $userId);
                $additionalPat = $query->skip(50)->take(PHP_INT_MAX)->get();
            } else {
                $additionalPat = Patients::where('Order_Status', $id)
                    ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
                    ->orderBy('created_at', 'desc')->skip(50)->take(PHP_INT_MAX)->get();
            }
            return view('partials.patients_partial', compact('additionalPat'))->render();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading additional patients.'], 500);
        }
    }

    public function patientDeptPendingList($id)
    {
        try {
            $userR = FacadesSession::get('LoginRole');
            $userId = FacadesSession::get('LoginId');
            $userView = FacadesSession::get('LoginViewCheck');
            if ($userR ==  "0") {
                $userd = FacadesSession::get('LoginDept');
                $deptIds = json_decode($userd, true) ?? [];

                $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewDept'), true) ?? [];

                if ($userView == 'on' && in_array($id, $viewOnlyDepts)) {
                    $query2 = Patients::where('Dept', $id)
                        ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at', 'resupplyDate', 'updated_at')
                        ->where('Order_Status', '!=', 17)
                        ->orderBy('created_at', 'desc');
                } else {
                    $query2 = Patients::where('Dept', $id)
                        ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at', 'resupplyDate', 'updated_at')
                        ->where('User', $userId)
                        ->orderBy('created_at', 'desc');
                }

                $additionalPat = $query2->skip(5)->take(PHP_INT_MAX)->get();
            } else {
                $additionalPat = Patients::where('Dept', $id)
                    ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at', 'resupplyDate', 'updated_at')
                    ->where('Order_Status', '!=', 17)
                    ->orderBy('created_at', 'desc')->skip(5)->take(PHP_INT_MAX)->get();
            }
            return view('partials.patients_partial', compact('additionalPat'))->render();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading additional patients.'], 500);
        }
    }



    public function DepartPatient($id)
    {
        $dp = Departments::select('Department', 'id')->get();
        $sdpt = subDept::all();
        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        $dptName = Departments::find($id);

        $patientsData = Patients::fetchPatients($userId, $userView);
        extract($patientsData);

        $aptQuery = Patients::where('Dept', $id)
            ->where('Order_Status', '!=', 17)
            ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at', 'resupplyDate', 'updated_at')
            ->orderBy('created_at', 'desc');
        if ($userR == "0") {
            $userd = json_decode(FacadesSession::get('LoginDept'), true) ?? [];
            $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewDept'), true) ?? [];

            if ($userView == 'on') {
                $ViewPatients =  Patients::select('Order_Status')->get();
            } else {
                $aptQuery->where('User', $userId);
            }
        }
        $apt = $aptQuery->paginate(50);


        $users = Users::find($userId);
        return view('departPatient', compact('sdpt', 'drs', 'st', 'dp', 'pt', 'users', 'apt', 'dptName', 'noti'));
    }



    public function BulkPatientChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|array|min:1',
            'AssigningDept' => 'required',
        ], [
            'AssigningDept.required' => 'Select the Department.',
            'status.required' => 'At least one status must be selected.',
            'status.min' => 'At least one status must be selected.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Select at least one status and Department.');
        }

        $userId = $request->userId;
        $dept = $request->AssigningDept;
        $statuses = $request->status;
        // dd($userId);

        // Fetch patients based on user ID, department, and status
        $patients = Patients::where('User', $userId)
            ->where('Dept', $dept)
            ->whereIn('Order_Status', $statuses)
            ->get();

        if ($request->filled('AssigningUser')) {
            $assignedUserId = $request->AssigningUser;
            foreach ($patients as $patient) {
                $patient->User = $assignedUserId;
                $patient->save();
            }
        } else {
            // Fetch users in the department excluding the current user
            $usersInDept = Users::whereJsonContains('Dept', $dept)
                ->where('status', '0')
                ->where('id', '!=', $userId)
                ->get();

            // Sort users by the count of patients assigned to each user
            $sortedUsers = $usersInDept->sortBy(function ($user) {
                return Patients::where('User', $user->id)->count();
            });

            // Assign patients equally among users
            $userIndex = 0;
            $userCount = $sortedUsers->count();

            foreach ($patients as $patient) {
                $currentUser = $sortedUsers[$userIndex];
                $patient->User = $currentUser->id;
                $patient->save();

                // Move to the next user, wrap around if needed
                $userIndex = ($userIndex + 1) % $userCount;
            }
        }

        return back()->with('success', 'Patients reassigned successfully.');
    }

    //Ajax Request

    public function GetUserDepart($id)
    {
        $us = Users::find($id);
        if (!$us) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $userDeptJson = $us->Dept; // Assuming the 'Dept' field stores the JSON array
        $userDepts = json_decode($userDeptJson, true); // Decode JSON to array

        $departments = Departments::whereIn('id', $userDepts)->pluck('id', 'Department');

        // Return the department names as a JSON response
        return response()->json($departments);
    }


    public function GetPatientsUser(Request $request, $UserId)
    {
        $user = Users::where('Dept', $UserId)
            ->where('status', '0')
            ->where('id', '!=', $UserId)
            ->get(['id', 'name']);


        // Return the filtered users as JSON response
        return response()->json($user);
    }





    public function viewUser($id)
    {
        $userId = FacadesSession::get('LoginId');
        Session()->put('HoldLoginId', $userId);
        $user = Users::find($id);

        if ($user) {
            $this->setSessionValues($user);
            return redirect('/');
        }

        return redirect('/Login');
    }

    public function BackToLogin($id)
    {
        $user = Users::find($id);

        if ($user) {
            $this->setSessionValues($user);
            session()->forget('HoldLoginId');
            return redirect('/');
        }

        return redirect('/login');
    }

    private function setSessionValues($user)
    {
        // dd($user);
        Session()->put('LoginId', $user->id);
        Session()->put('LoginBulkPer', $user->BulkPer);
        Session()->put('LoginviewUser', $user->userViewPermisiion);
        Session()->put('LoginName', $user->name);
        Session()->put('LoginRole', $user->role);
        Session()->put('LoginDept', $user->Dept);
        Session()->put('LoginMail', $user->email);
        Session()->put('LoginViewCheck', $user->viewOnly);
        Session()->put('LoginPasswordCheck', $user->ChangePassword);
        Session()->put('LoginAdd', $user->add);
        Session()->put('LoginEdit', $user->edit);
        Session()->put('LoginCancel', $user->cancel);
        Session()->put('LoginHold', $user->hold);
        Session()->put('LoginClose', $user->close);
        Session()->put('LoginDelete', $user->delete);
        Session()->put('LoginProgress', $user->progress);
        Session()->put('LoginViewDept', $user->ViewDept);
        Session()->put('LoginDeleteDoc', $user->deleteDocs);
        Session()->put('LoginEditDoc', $user->editDocs);
        Session()->put('LoginMailPermission', $user->permission);
    }



    public function StatusPatient($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userR = FacadesSession::get('LoginRole');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];

            $query = Patients::whereIn('Dept', $deptIds)->where('Order_Status', $id)
                ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
                ->orderBy('created_at', 'desc')->where('User', $userId);
            $pat = $query->paginate(50);

            $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewDept'), true) ?? [];

            $ViewPatients = Patients::whereIn('Dept', $viewOnlyDepts)
                ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
                ->get();
        } else {
            $pat = Patients::where('Order_Status', $id)
                ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
                ->orderBy('created_at', 'desc')->paginate(50);
            $ViewPatients =  Patients::select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $stName = Status::find($id);
        $stName = $stName->Status;
        $dp = Departments::select('Department', 'id')->get();
        $users = Users::find($userId)->value('Dept');

        return view('StatusPatient', compact('stName', 'drs', 'st', 'dp', 'pt', 'users',  'pat', 'ViewPatients', 'noti'));
    }


    public function documentList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $documentIds = documents::pluck('ptName')->toArray();

        $patients = Patients::whereIn('id', $documentIds)->select('id', 'name', 'last_name', 'AccNumber', 'Order_No')->get()->keyBy('id');

        // Get the documents
        $documents = documents::select('Order_No', 'toDate', 'upload', 'created_at', 'docType', 'id', 'ptName')->get();
        $doctor =  Doctors::select('Office_Name', 'id')->get();
        return view('documentList', compact('documents', 'st',  'pt', 'drs', 'doctor', 'noti', 'patients'));
    }




    public function AddDocument(Request $request)
    {
        $lastOrderNo = documents::orderBy('created_at', 'desc')->first(['Order_No']);
        $docNumber = $lastOrderNo ? $lastOrderNo->Order_No + 1 : 10001;

        $document = new documents();
        $document->Order_No = $docNumber;
        $document->OrderID = $request->ptOrderId;
        $document->docType = $request->docs;
        $document->subDocType = $request->subDoc;
        $document->title = $request->title;
        $document->type = $request->type;
        $document->desc = $request->desc;
        $document->ptName = $request->ptName;
        $document->ptDr = $request->drOff;
        $document->ptAcc = $request->patientAcc;
        $document->ptOrder = $request->patientOrder;


        $rules = [];
        $customMessages = [];
        if ($request->filled('PFDate') || $request->docs == "Proof of Delivery") {
            $rules['PFDate'] = 'required';
            $customMessages['PFDate.required'] = 'Date Of Service is required.';
            $document->fromDate = $request->PFDate;
        } elseif ($request->filled('DOS') || $request->docs == "Consignment Documents") {
            $rules = [
                'DOS' => 'required',
                'FDate' => 'required',
                'TDate' => 'required',
            ];
            $customMessages = [
                'DOS.required' => 'Date Of Service is required.',
                'FDate.required' => 'From Prescription RX Date is required.',
                'TDate.required' => 'TO Prescription RX Date is required.',
            ];
            $document->DOS = $request->DOS;
            $document->fromDate = $request->FDate;
            $document->toDate = $request->TDate;
        } elseif (in_array($request->docs, ["Prescription (RX)", "Authorization", "CMN"])) {
            $rules = [
                'FDate' => 'required',
                'TDate' => 'required',
            ];
            $customMessages = [
                'FDate.required' => 'From Prescription RX Date is required.',
                'TDate.required' => 'To Prescription RX Date is required.',
            ];
            $document->fromDate = $request->FDate;
            $document->toDate = $request->TDate;
        }

        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Please fill in the required dates.');
        }

        $fileRules = [
            'img' => 'required|mimes:pdf,heic,jpeg,jpg,png,tiff,tif',
        ];
        $fileMessages = [
            'img.required' => 'The file is required.',
            'img.mimes' => 'The file must be a type of: pdf, heic, jpeg, jpg, png, tiff, tif.',
        ];
        $fileValidator = Validator::make($request->all(), $fileRules, $fileMessages);
        if ($fileValidator->fails()) {
            return back()->withErrors($fileValidator)->withInput()->with('error', 'Please upload a valid file.');
        }

        $uniqueFilename = (string) Str::uuid() . '_' . time() . '.' . $request->img->getClientOriginalExtension();
        $request->img->move('documents', $uniqueFilename);
        $document->img = $uniqueFilename;

        $document->freq = $request->duration;
        $document->upload = FacadesSession::get('LoginName');
        $document->save();

        $ac = new Activity();
        $ac->PtId = $request->ptName;
        $ac->name = FacadesSession::get('LoginName');
        $ac->OrderID = $request->ptOrderId;
        $ac->message = $document->upload . ' Uploaded ' . $document->docType . ' document.';
        $ac->save();

        $patient = Patients::find($request->ptName);
        $user = Users::find($patient->User);
        $data = [
            'patient_name' => $patient->name . " " . $patient->last_Name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => $user?->email,
            'assigned' => $user?->name,
            'document_type' => $request->docs,
            'ptId' => $request->ptName,
            'assign' => $patient?->User,
            'UserID' => $patient?->User,
        ];

        // $this->notify('add_new_document', $data);

        return back()->with('success', 'Documents added successfully.');
    }




    public function serveDocument($identifier)
    {
        $this->clearCache();
        $myfile = fopen('logs.txt', "a") or die("Unable to open file!");
        fwrite($myfile, "\nIdentifier: " . $identifier);
        $document = documents::where('img', $identifier)->firstOrFail();
        fwrite($myfile, "\nDocument: " . json_encode($document));

        $filePath = base_path('documents/' . $document->img);

        fwrite($myfile, "\nFile Path: " . $filePath);

        // if (!file_exists($filePath)) {
        //     fwrite($myfile, "\nFile does not exist.");
        //     fclose($myfile);
        //     abort(404);
        // } else {
        //     fwrite($myfile, "\nFile exists.");
        // }

        fclose($myfile);

        return response()->file($filePath);
    }



    public function EditDocument($id, Request $request)
    {
        $dc = documents::find($id);
        $dc->docType = $request->docs;
        $dc->subDocType = $request->subDocEdit;
        $dc->title = $request->title;
        $dc->type = $request->type;
        $dc->desc = $request->desc;
        $dc->ptName = $request->ptName;
        $dc->ptDr = $request->drOff;
        $dc->ptAcc = $request->patientAcc;
        $dc->ptOrder = $request->patientOrder;

        if ($request->filled('PFDateEdit') && $request->docs == "Proof of Delivery") {
            $dc->fromDate = $request->PFDateEdit;
        } elseif ($request->filled('DOS')) {
            $dc->DOS = $request->DOSEdit;
            $dc->fromDate = $request->FDateEdit;
            $dc->toDate = $request->TDateEdit;
        } else {
            $dc->fromDate = $request->FDateEdit;
            $dc->toDate = $request->TDateEdit;
        }

        $dc->freq = $request->durationEdit;
        $dc->upload = FacadesSession::get('LoginName');

        if ($request->has('fileUploadEdit')) {
            $second  = $request->fileUploadEdit;
            $imagename1 = date('Y-m-d-His') . time() . '.' . $second->getClientOriginalExtension();
            $request->fileUploadEdit->move('documents', $imagename1);
            $dc->img = $imagename1;
        }
        $dc->updated_at = now();

        if (empty($dc->editName) && empty($dc->editTIme)) {
            $dc->editTIme = json_encode([now()]);
            $dc->editName = json_encode([FacadesSession::get('LoginName')]);
        } else {
            $editNameArray = json_decode($dc->editName);
            $editTimeArray = json_decode($dc->editTIme);

            $editNameArray[] = FacadesSession::get('LoginName');
            $editTimeArray[] = now();

            $dc->editName = json_encode($editNameArray);
            $dc->editTIme = json_encode($editTimeArray);
        }

        $dc->save();

        $ac = new Activity();
        $ac->PtId =  $request->ptName;
        $ac->name = FacadesSession::get('LoginName');
        $ac->message = $dc->upload . ' Update the Uploaded document.';
        $ac->save();
        $pt = Patients::find($dc->ptName);
        $user = Users::find($pt->User);

        $data = [
            'patient_name' => $pt->name . " " . $pt->last_Name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => [$user->email], // Ensure this is an array
            'assigned' => $user->name, // Ensure this is an array
            'document_type' => $dc->docType,
            'ptId' => $dc->ptName,
            'assign' => $pt->User,
            'UserID' => $pt->User,
        ];

        $this->notify('edit_document', $data);


        return back()->with('success', 'Documents added successfully.');
    }



    public function assignToResupplyUser()
    {
        $today = Carbon::now()->format('Y-m-d');

        $assigned = Patients::where('new_date', $today)->get();

        if ($assigned->isEmpty()) {
            return response()->json(['message' => 'No Reassign to any user found for today.']);
        }

        foreach ($assigned as $reminder) {
            $newUser = Patients::find($reminder->id);
            if ($newUser) {
                $newUser->Dept = $reminder->newdept;
                $newUser->User = $this->assignLeastBusyUser($reminder->newdept);
                $newUser->resupplyDate = $newUser->new_date;
                $daysToAdd = (int) $newUser->new_frequency; // Cast to int to ensure it's a number
                $newUser->new_date = Carbon::createFromFormat('Y-m-d', $newUser->new_date)
                    ->addDays($daysToAdd)
                    ->format('Y-m-d');
                $newUser->Order_Status = '5';
                $newUser->save();
                $us = users::find($newUser->User);
                $data = [
                    'pat_name' => $newUser->name . " " . $newUser->last_Name,
                    'depart' => $reminder->newdept,
                    'added_by' => FacadesSession::get('LoginName'),
                    'assigned_users' => $us->email, // Ensure this is an array
                    'assigned' => $us->name, // Ensure this is an array
                    'ptId' => $reminder->id,
                    'UserID' => $reminder->id,
                ];

                $this->notify('Assigned_New_Resupply_user', $data);
            }
        }

        return response()->json(['message' => 'User set successfully']);
    }




    //User & Dept Progress Start

    public function Progress()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $dp = Departments::all();
        $pat = Patients::orderBy('created_at', 'desc')->get();
        $excludedUserIds = [7, 3];
        $users = Users::whereNotIn('id', $excludedUserIds)->get('*');

        $patientsByUserStatus = [];

        // Retrieve patient counts for each user, department, and status combination
        foreach ($users as $user) {
            $departmentsIds = json_decode($user->departments, true);
            if (is_array($departmentsIds)) {
                foreach ($departmentsIds as $departmentId) {
                    if (!isset($patientsByUserStatus[$user->id][$departmentId])) {
                        $patientsByUserStatus[$user->id][$departmentId] = [];
                    }

                    foreach ($st as $status) {
                        if (!isset($patientsByUserStatus[$user->id][$departmentId][$status->id])) {
                            $patientsByUserStatus[$user->id][$departmentId][$status->id] = 0;
                        }
                        $count = Patients::where('User', $user->id)
                            ->where('Dept', $departmentId)
                            ->where('Order_Status', $status->id)
                            ->count();
                        $patientsByUserStatus[$user->id][$departmentId][$status->id] = $count;
                    }
                }
            }
        }

        return view('progress', compact('drs', 'st', 'dp', 'pt', 'users', 'patientsByUserStatus', 'pat', 'noti'));
    }


    public function filterDeptProgress($id)
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        $userR = FacadesSession::get('LoginRole');
        if ($userR == "2") {
            $pat = $drs;
        } else {
            $pat = Patients::orderBy('created_at', 'desc')->get();
        }

        $dp = Departments::all();

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        switch ($id) {
            case '01': // Today
                $deppat = Patients::whereDate('created_at', '=', $today)->orderBy('created_at', 'desc')->get();
                break;
            case '02': // Yesterday
                $deppat = Patients::whereDate('created_at', '=', $yesterday)->orderBy('created_at', 'desc')->get();
                break;
            case '03': // This Week
                $deppat = Patients::whereBetween('created_at', [$startOfWeek, $endOfWeek])->orderBy('created_at', 'desc')->get();
                break;
            case '04': // Last Week
                $deppat = Patients::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->orderBy('created_at', 'desc')->get();
                break;
            case '05': // This Month
                $deppat = Patients::whereBetween('created_at', [$startOfMonth, $endOfMonth])->orderBy('created_at', 'desc')->get();
                break;
            case '06': // Last Month
                $deppat = Patients::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->orderBy('created_at', 'desc')->get();
                break;
            default:
                $deppat = Patients::orderBy('created_at', 'desc')->get();
        }

        $users = Users::whereNotIn('id', [2, 3])->get('*');

        return view('progress', compact('drs', 'st', 'dp', 'pt', 'users', 'pat', 'deppat', 'noti'));
    }

    public function FilterProgressPatient(Request $request)
    {
        $dp = Departments::all();
        $dateFilter = $request->date;

        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        $userR = FacadesSession::get('LoginRole');
        if ($userR == "2") {
            $deppat = $drs;
            $pat = Patients::query();
        } else {
            $deppat = Patients::orderBy('created_at', 'desc')->get();
            $pat = Patients::query();
        }


        switch ($dateFilter) {
            case '1': // Yesterday
                $pat->whereDate('created_at', '=', Carbon::yesterday()->toDateString());
                break;
            case '2': // This Week
                $pat->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case '3': // This Month
                $pat->whereMonth('created_at', '=', Carbon::now()->month)
                    ->whereYear('created_at', '=', Carbon::now()->year);
                break;
            case '4': // Today
                $pat->whereDate('created_at', '=', Carbon::today()->toDateString());
                break;
        }

        // Status filter
        if ($request->has('status') && !is_null($request->status)) {
            $pat->where('Order_Status', $request->status);
        }

        // Department filter
        if ($request->has('dept') && !is_null($request->dept)) {
            $pat->where('Dept', $request->dept);
        }

        // Execute the query
        $pat = $pat->orderBy('created_at', 'desc')->get();

        $users = Users::whereNotIn('id', [2, 3])->get('*');


        return view('progress', compact('drs', 'st', 'dp', 'pt', 'users', 'pat', 'deppat', 'noti'));
    }


    //User & Dept Progress end



    //reminder
    public function Reminders()
    {
        //       $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $uid = FacadesSession::get('LoginId');

        $st = Status::all();
        $dp = Departments::all();
        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $query = Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc');
            if ($userView != 'on') {
                $query = $query->where('User', $userId);
            }
            $drs = $query->get();
            $pt =  $drs->count();
        } else {
            $pt =  Patients::count();
            $drs = Patients::orderBy('created_at', 'desc')->get();
        }
        $users = Users::find($userId);


        $log = Reminders::where('UId', $uid)->orderBy('created_at', 'desc')->get();

        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        return view('Reminders', compact('drs', 'st', 'pt', 'log', 'noti'));
    }

    public function editReminder($id)
    {
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $uid = FacadesSession::get('LoginId');
        $log = Reminders::find($id);
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('editReminder', compact('drs', 'st', 'pt', 'log', 'noti'));
    }


    public function EditReminderDetail($id, Request $request)
    {
        $request->validate([
            'Reminder' => 'required',
            'date' => 'required',
        ]);
        $no = Reminders::find($id);
        $no->name = FacadesSession::get('LoginName');
        $no->UId = FacadesSession::get('LoginId');
        $no->Reminder = $request->Reminder;
        $no->date = $request->date;

        // Temporarily disable automatic timestamps
        $no->timestamps = false;

        // Set updated_at to null
        $no->updated_at = null;

        // Save the model without automatic timestamp updating
        $no->save();

        // Re-enable automatic timestamps if needed elsewhere
        $no->timestamps = true;

        return redirect('Reminders')->with('success', '');
    }

    public function DeleteReminder($id)
    {
        $st = Reminders::find($id);
        $st->delete();
        return back();
    }


    public function AddReminders(Request $request)
    {
        $request->validate([
            'Reminder' => 'required',
            'date' => 'required',
        ]);

        $no = new Reminders();
        $no->name = FacadesSession::get('LoginName');
        $no->UId = FacadesSession::get('LoginId');
        $no->Reminder = $request->Reminder;
        $no->updated_at = null;
        $no->date = $request->date;
        $no->save();
        return back()->with('success', '');
    }


    //SUb Dept

    public function addSubDept()
    {
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('AddSubDept', compact('drs', 'st', 'pt', 'noti'));
    }


    public function RegisterSubDepart(Request $request)
    {
        $request->validate([
            'Department' => 'required',
        ]);
        $st = new subDept();
        $st->SubDept = $request->Department;
        $st->save();
        return redirect::to('SubDepartList')->with('success', '');
    }

    public function SubDepartList()
    {
        $subpat = subDept::orderBy('created_at', 'desc')->get();
        $dr = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('subDeptList', compact('drs', 'dr', 'st', 'pt', 'subpat', 'noti'));
    }

    public function editSubDepart($id)
    {
        $s = subDept::find($id);
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('editSubDept', compact('s', 'drs', 'st', 'pt', 'noti'));
    }



    public function EditSubDepartDetail($id, Request $request)
    {
        $request->validate([
            'Department' => 'required',
        ]);
        $st = subDept::find($id);
        $st->SubDept = $request->Department;
        $st->save();
        return redirect('SubDepartList')->with('success', '');
    }

    public function DeleteSubDepartment($id)
    {
        $st = subDept::find($id);
        $st->delete();
        return back();
    }


    //SUb Dept

    public function terms()
    {
        $st = Status::all();
        $dp = Departments::all();
        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $drs = Patients::whereIn('Dept', $deptIds)->where('User', $userId)->orderBy('created_at', 'desc')->get();
            $pt =  $drs->count();
        } else {
            $pt =  Patients::count();
            $drs = Patients::orderBy('created_at', 'desc')->get();
        }
        $users = Users::find($userId);
        return view('terms', compact('drs', 'st', 'dp', 'pt', 'users', 'noti'));
    }

    public function backup_restore()
    {
        $st = Status::all();
        $dp = Departments::all();
        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $drs = Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc')->get();
            $pt =  $drs->count();
        } else {
            $pt =  Patients::count();
            $drs = Patients::orderBy('created_at', 'desc')->get();
        }
        $users = Users::find($userId);
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('backup&restore', compact('drs', 'st', 'dp', 'pt', 'users', 'noti'));
    }

    public function createAndDownloadBackup()
    {
        Artisan::call('backup:run --only-db');
        $backupPath = storage_path('app/');
        $backupFiles = collect(Storage::disk('local')->allFiles('Laravel'))->sort()->reverse()->values();

        if ($backupFiles->isEmpty()) {
            return abort(404, 'Backup file not found.');
        }
        $latestBackup = $backupFiles->first();
        return response()->download($backupPath . '/' . $latestBackup);
    }


    public function HistoryList()
    {
        $userId = FacadesSession::get('LoginId');
        $userd = FacadesSession::get('LoginDept');
        $deptIds = json_decode($userd, true) ?? [];
        $his = History::where('UId', $userId)->orderBy('created_at', 'desc')->get();
        $query =  Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc');
        $st = Status::all();

        $userView = FacadesSession::get('LoginViewCheck');
        if ($userView != 'on') {
            $query = $query->where('User', $userId);
        }
        $dr = $query->get();
        $pt =  $dr->count();


        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('historylist', compact('drs', 'dr', 'st', 'pt', 'his', 'noti'));
    }


    public function PatientHistory()
    {
        $his = History::orderBy('created_at', 'desc')->get();
        $query =  Patients::orderBy('created_at', 'desc');
        $st = Status::all();
        $dr = $query->get();
        $pt =  $dr->count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('historylist', compact('drs', 'dr', 'st', 'pt', 'his', 'noti'));
    }



    public function LogsList()
    {
        $log = Logs::orderBy('created_at', 'desc')->get();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('logsList', compact('drs', 'st', 'pt', 'log', 'noti'));
    }

    public function notifications()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        $userR = FacadesSession::get('LoginRole');
        $userMailPer = FacadesSession::get('LoginMailPermission');

        $permissionValues = json_decode($userMailPer, true);

        if (!empty($permissionValues)) {
            // Get the notifications based on the user ID and the types in the session
            $notification = Notifications::where(function ($query) use ($userId, $permissionValues) {
                $query->where('UserId', $userId)
                    ->orWhereIn('type', $permissionValues);
            })
                ->orWhere('UserId', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // If LoginMailPermission is null or empty, get notifications based on the user ID only
            $notification = Notifications::where('UserId', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
        }


        extract(Patients::fetchPatients($userId, $userView));
        return view('notifications', compact('drs', 'st', 'pt', 'noti', 'notification'));
    }



    public function PatientReport(Request $request)
    {
        // Increase the maximum execution time and memory limit
        ini_set('max_execution_time', 3600); // 1 hour
        ini_set('memory_limit', '2048M'); // 2GB

        $startDate = $request->startDate;
        $endDate = $request->endDate;

        // Query to get patients within the specified date range, ordered by creation date
        $patientsQuery = Patients::whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->orderBy('created_at', 'desc');
        $chunkSize = 1500; // Adjust based on your memory limits and data size

        $allPatientsData = [];

        // Process the data in chunks to avoid memory overload
        $patientsQuery->chunk($chunkSize, function ($patients) use (&$allPatientsData) {
            foreach ($patients as $patient) {
                $allPatientsData[] = $patient->toArray(); // Convert each patient to an array to save memory
            }
        });

        // Prepare data for the PDF view
        $data = [
            'pat' => $allPatientsData,
        ];

        // Generate the PDF using the view 'pdf.patients'
        $pdf = PDF::loadView('pdf.patients', $data);
        $pdf->setPaper('a4', 'portrait'); // Adjust paper size and orientation
        $pdf->getDomPDF()->set_option('enable_html5_parser', true); // Enable HTML5 parser for better CSS compatibility

        // Stream the generated PDF to the browser
        return $pdf->stream('PatientList.pdf');
    }




    public function MainPatientReport(Request $request)
    {
        // Set memory and execution limits
        ini_set('max_execution_time', 3600); // 1 hour
        ini_set('memory_limit', '1024M'); // 1GB

        // Get date range from request
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        // Use Lazy Collection to handle large datasets efficiently
        $patientsData = Patients::whereBetween('created_at', ["$startDate 00:00:00", "$endDate 23:59:59"])
            ->orderBy('created_at', 'desc')
            ->cursor(); // Using cursor() instead of get() to use Lazy Collection

        $statuses = Status::all();
        $depts = Departments::all();

        // Prepare data for PDF generation
        $data = [
            'pets' => [],
            'status' => $statuses,
            'depts' => $depts,
        ];

        foreach ($patientsData as $patient) {
            $data['pets'][] = $patient->toArray();

            // Clear the memory to avoid memory leak
            if (count($data['pets']) % 500 == 0) {
                gc_collect_cycles();
            }
        }

        // Generate the PDF
        $pdf = PDF::loadView('pdf.MainReport', $data);
        $pdf->setPaper('a4', 'portrait'); // Adjust paper size and orientation
        $pdf->getDomPDF()->set_option('enable_html5_parser', true); // Enable HTML5 parser for better CSS compatibility

        // Return the PDF stream
        return $pdf->stream('PatientList.pdf');
    }




    public function RequestPatients($id)
    {

        $dp = Departments::all();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        $userR = FacadesSession::get('LoginRole');
        extract(Patients::fetchPatients($userId, $userView));
        $allpt = Patients::all();
        $users = Users::find($userId);

        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $query = Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc')->where('User', $userId);
            $pat = $query->get();
            if ($id == "1") {
                $pta = Patients::where('request', 1)->where('User', $userId)->orderBy('created_at', 'desc')->get();
                $headname = "Cancel";
            } elseif ($id == "2") {
                $pta = Patients::where('request', 2)->where('User', $userId)->orderBy('created_at', 'desc')->get();
                $headname = "Hold";
            } elseif ($id == "3") {
                $pta = Patients::where('request', 3)->where('User', $userId)->orderBy('created_at', 'desc')->get();
                $headname = "Closed";
            } else {
                return back();
            }
        } else {
            if ($id == "1") {
                $pta = Patients::where('request', 1)->orderBy('created_at', 'desc')->get();
                $headname = "Cancel";
            } elseif ($id == "2") {
                $pta = Patients::where('request', 2)->orderBy('created_at', 'desc')->get();
                $headname = "Hold";
            } elseif ($id == "3") {
                $pta = Patients::where('request', 3)->orderBy('created_at', 'desc')->get();
                $headname = "Closed";
            } else {
                return back();
            }
            $pat = Patients::orderBy('created_at', 'desc')->get();
        }




        return view('RequestPatients', compact('drs', 'st', 'pt', 'dp', 'allpt', 'users', 'pat', 'pta', 'headname', 'noti'));
    }

    public function FilterPatient2(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'status' => 'required',
        ]);


        $query = Patients::query();

        if ($request->date != "0") {
            switch ($request->date) {
                case "1":
                    $query->whereBetween('created_at', [Carbon::yesterday()->startOfDay(), now()]);
                    break;
                case "2": // Week
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case "3": // Month
                    $query->whereMonth('created_at', now()->month);
                    break;
                case "4":
                    $query->whereDate('created_at', now());
                    break;
            }
        }
        if ($request->has('dept')) {
            $query->where([['Order_Status', $request->status], ['Dept', $request->dept]]);
        } else {
            $query->where('Order_Status', $request->status);
        }

        $userR = FacadesSession::get('LoginRole');

        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $drs = $query->whereIn('Dept', $deptIds)->orderBy('created_at', 'desc')->get();
            $pt =  Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc')->count();
        } else {
            $pt =  Patients::count();
            $drs = $query->orderBy('created_at', 'desc')->get();
        }

        $st = Status::all();
        $dp = Departments::all();
        $userId = FacadesSession::get('LoginId');
        $users = Users::find($userId);
        $apt =  Patients::All();
        return view('FilterdPatients', compact('drs', 'st', 'dp', 'pt', 'users', 'apt', 'noti'));
    }



    public function subDept($id)
    {
        $subpat = Patients::where('resupplyCat', $id)
            ->where('Dept', '6')
            ->orderBy('created_at', 'desc')
            ->get();
        $st = Status::all();
        $dp = Departments::all();
        $pt =  Patients::count();

        $subDeptName = $id;

        $userR = FacadesSession::get('LoginRole');
        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $apt = Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc')->get();
            $pt =  $apt->count();
        } else {
            $pt =  Patients::count();
            $apt = Patients::orderBy('created_at', 'desc')->get();
        }

        $userId = FacadesSession::get('LoginId');
        $users = Users::find($userId);

        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('subDept', compact('drs', 'st', 'dp', 'pt', 'users', 'apt', 'subDeptName', 'subpat', 'noti'));
    }

    public function ResupplyPatient($id)
    {
        $dptName = "";
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        if ($id == 0) {
            if ($userR ==  "0") {
                $userd = FacadesSession::get('LoginDept');
                $deptIds = json_decode($userd, true) ?? [];
                $userView = FacadesSession::get('LoginViewCheck');
                $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewDept'), true) ?? [];

                if ($userView == 'on' && in_array($id, $viewOnlyDepts)) {
                    $query = Patients::whereIn('Dept', $deptIds)
                        ->where('resupplyDate', '<=', $tomorrow)->where('Order_Status', '5')
                        ->orderBy('created_at', 'desc');
                    $query2 = Patients::where('Dept', $id)->orderBy('created_at', 'desc');
                } else {
                    $query = Patients::whereIn('Dept', $deptIds)->where('User', $userId)->where('resupplyDate', '<=', $tomorrow)->where('Order_Status', '5')
                        ->orderBy('created_at', 'desc');
                    $query2 = Patients::where('Dept', $id)->where('User', $userId)->orderBy('created_at', 'desc');
                }

                $pat = $query->get();
                $allpt = $query->get();
            } else {
                $pt =  Patients::count();
                $allpt = Patients::orderBy('created_at', 'desc')->get();
                $pat = $allpt->where('resupplyDate', '<=', $tomorrow)->where('Order_Status', '5');


                $dptName = "Resupply Patients";
            }
        } elseif (is_numeric($id)) {
            $userView = FacadesSession::get('LoginViewCheck');
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];

            $query = Patients::where('Dept', $id)->where('Order_Status', '5')->where('resupplyDate', '<=', $tomorrow)
                ->orderBy('created_at', 'desc');
            $query2 = Patients::where('Dept', $id)->where('Order_Status', '5')->where('resupplyDate', '<=', $tomorrow)->orderBy('created_at', 'desc');

            $pat = $query->get();
            $allpt = $query2->get();

            // $allpt = Patients::where('User',$userId)->get();
            $dptName = Departments::find($id)->name ?? "Unknown Department";
        } else {
            $pat = Patients::where('resupplyCat', $id)
                ->whereDate('resupplyDate', '<=', $tomorrow)->where('User', $userId)
                ->orderBy('created_at', 'desc')
                ->get();
            $allpt = Patients::where('User', $userId)->get();
            $dptName .= " / " . $id . " Resupply Patients";
        }
        $st = Status::all();
        $dp = Departments::all();
        $pt =  Patients::count();
        $allPt = Patients::all();
        $userR = FacadesSession::get('LoginRole');


        $userView = FacadesSession::get('LoginViewCheck');


        $userId = FacadesSession::get('LoginId');
        $users = Users::find($userId);

        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        return view('resupply', compact('pat', 'drs', 'st', 'dp', 'pt', 'users', 'allpt', 'allPt', 'noti'));
    }

    public function followUpPatient($id)
    {
        $twentyFourHoursAgo = Carbon::now()->subHours(24);
        $userRole = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $dptName = "Resupply Patients"; // Default name, adjust as needed


        $userView = FacadesSession::get('LoginViewCheck');
        if ($id != 0) {

            if ($userRole ==  "0") {
                $userd = FacadesSession::get('LoginDept');
                $deptIds = json_decode($userd, true) ?? [];

                $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewDept'), true) ?? [];


                if ($userView == 'on' && in_array($id, $viewOnlyDepts)) {
                    $query = Patients::whereIn('Dept', $deptIds)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])->where('updated_at', '<=', $twentyFourHoursAgo)->orderBy('created_at', 'desc');
                    $query2 = Patients::where('Dept', $id)->where('User', $userId)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])->where('updated_at', '<=', $twentyFourHoursAgo)->orderBy('created_at', 'desc');
                } else {
                    $query = Patients::whereIn('Dept', $deptIds)->where('User', $userId)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])->where('updated_at', '<=', $twentyFourHoursAgo)->orderBy('created_at', 'desc');
                    $query2 = Patients::where('Dept', $id)->where('User', $userId)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])->where('updated_at', '<=', $twentyFourHoursAgo)->orderBy('created_at', 'desc');
                }

                $pat = $query2->get();
            } else {
                $allpt = Patients::all();
                $query = new Patients;
                $pat = Patients::where('Dept', $id)->where('updated_at', '<=', $twentyFourHoursAgo)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }
        if ($id != 0) {
            $query = $query->where('Dept', $id);
            $department = Departments::find($id);
            $dptName = $department ? $department->name : "Department not found";
        } else {
            if ($userRole ==  "0") {
                $pat = Patients::where('updated_at', '<=', $twentyFourHoursAgo)->where('User', $userId)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $pat = Patients::where('updated_at', '<=', $twentyFourHoursAgo)->whereNotIn('Order_Status', [17, 18, 16, 5, 28])
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        $dp = Departments::all();
        $users = Users::find($userId);
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $allPt = Patients::all();
        return view('followup', compact('drs', 'pat', 'st', 'dp', 'pt', 'users', 'dptName', 'allPt', 'noti'));
    }




    // Patient Section Starts

    public function AddPatient()
    {
        $st = Status::orderBy('order', 'asc')->get();
        $dr = Doctors::all();
        $us = Users::all();
        $dp = Departments::all();
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $pt =  Patients::count();
        $subDept = subDept::all();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        return view('AddPatient', compact('st', 'dr', 'us', 'dp', 'drs', 'pt', 'subDept', 'noti'));
    }




    public function DepartmentUser(Request $request, $deptId)
    {
        $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewCheck'), true) ?: [];
        if (!is_array($viewOnlyDepts)) {
            $viewOnlyDepts = [];
        }

        $selectedStatus = $request->input('selectedStatus');
        if ($selectedStatus == "pending") {
            $selectedDeptId = $request->input('actualDeptId');
            $users = Users::where(function ($query) use ($viewOnlyDepts) {
                $query->where('viewOnly', '!=', 'on')
                    ->orWhereNotIn('Dept', $viewOnlyDepts);
            })
                ->where('status', '0')
                ->whereJsonContains('Dept', (string)$selectedDeptId)
                ->get();
            // Filter logic remains the same
            $filteredUsers = $users->filter(function ($user) use ($selectedDeptId) {
                $ordersCount = Patients::where('User', $user->id)
                    ->where('Dept', $selectedDeptId)
                    ->count();
                return $ordersCount < ($user->max_pending_order ?? 0) - 1;
            });
        } else {
            // Similar adjustment for the else condition
            $filteredUsers = Users::where(function ($query) use ($viewOnlyDepts) {
                $query->where('viewOnly', '!=', 'on')
                    ->orWhereNotIn('Dept', $viewOnlyDepts);
            })
                ->where('status', '0')
                ->whereJsonContains('Dept', "$deptId")
                ->get();
        }

        return response()->json($filteredUsers);
    }




    public function editPatient($id)
    {
        $patients = Patients::find($id);
        $st = Status::orderBy('order', 'asc')->get();
        $dr = Doctors::all();
        $us  = Users::whereJsonContains('Dept', $patients->Dept)->get();

        $use = Users::where('viewOnly', null)->where('status', '0')->get();
        $dp = Departments::all();
        $userR = FacadesSession::get('LoginRole');
        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $drs = Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc')->get();
            $pc =  $drs->count();
        } else {
            $pc =  Patients::count();
            $drs = Patients::orderBy('created_at', 'desc')->get();
        }

        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        $subDept = subDept::all();
        return view('editPatient', compact('patients', 'st', 'dr', 'us', 'dp', 'pc', 'drs', 'pt', 'subDept', 'noti'));
    }

    public function getDocumentDetails($id)
    {
        $document = documents::find($id);
        if ($document) {

            $document->editName = json_decode($document->editName);

            $document->editTIme = json_decode($document->editTIme);
        }
        return response()->json($document);
    }


    public function DeleteDocument($id)
    {
        $st = documents::find($id);
        $pt = Patients::find($st->ptName);
        $user = Users::find($pt->User);
        $st->delete();
        $ac = new Activity();
        $ac->PtId = $st->ptName;
        $ac->OrderID = $st->OrderID;
        $ac->name = FacadesSession::get('LoginName');
        $ac->message = FacadesSession::get('LoginName') . ' Delete the ' . $st->docType . ' document.';
        $ac->save();
        $data = [
            'patient_name' => $pt->name . " " . $pt->last_Name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => $user?->email, // Ensure this is an array
            'assigned' => $user?->name, // Ensure this is an array
            'document_type' => $st->docType,
            'ptId' => $st->ptName,
            'assign' => $st?->User,
            'UserID' => $st?->User,
        ];

        $this->notify('delete_document', $data);

        return back();
    }


    public function getDetails($id)
    {
        $patient = Patients::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json([
            'office_id' => $patient->Off_Name ?? '', // Assuming a patient has a related doctor
            'account_number' => $patient->AccNumber,
            'order_number' => $patient->Order_No,
            'Dept' => $patient->Dept
        ]);
    }






    public function PatientDetail($id)
    {
        Session()->put('previous_url', url()->previous());
        $tp = Patients::find($id);
        $act = Activity::where('PtId', $id)->select('message', 'name', 'created_at', 'OrderID')->orderBy('created_at', 'desc')->get();
        $not = Notes::where('PtId', $id)->select('note', 'name', 'created_at', 'OrderID')->orderBy('created_at', 'desc')->get();
        $dp = Departments::select('id', 'Department')->get();
        $userName = Users::whereJsonContains('Dept', $tp->Dept)->select('name', 'id')->get();
        $pati =  Patients::select('id', 'name', 'last_Name')->get();
        $doctor =  Doctors::select('Office_Name', 'id')->get();
        $PatInsurance =  PatientInsurance::where('PatientID', $id)->select('Policy', 'id', 'Company', 'Group')->orderBy('created_at', 'desc')->get();
        $da =  documents::where('ptName', $id)->orderBy('created_at', 'desc')->get();
        $Orders = Orders::where('Patient_ID', $id)->select('id', 'Items', 'created_at', 'CreatedBy', 'Department', 'OrderStatus')->orderBy('created_at', 'desc')->get();
        $predefinedNotes = PreferredNotes::all();
        $icd9 = ICDNine::select('Code')->orderBy('created_at', 'desc')->get();
        $icd10 = ICDTen::select('Code')->orderBy('created_at', 'desc')->get();
        $diagnosis = Diagnosis::where([['PatientID', $id], ['OrderID', null]])->first();

        $copayment = Copayment::where('PatientID', $id)->first();
        $invoiceForm = InvoiceForm::select('name')->orderBy('created_at', 'desc')->get();
        $taxes = Taxes::select('Name', 'TotalTax')->orderBy('created_at', 'desc')->get();

        $totalPrice = 0;

        foreach ($Orders as $order) {
            $orderItems = OrderItems::where('uniqueOrderId', $order->Items)->pluck('itemId');
            $prices = PriceCode::whereIn('Item', $orderItems)->pluck('AllowablePrice');
            $totalPrice += $prices->sum();
        }

        $insurancePayment = 0;

        foreach ($PatInsurance as $value) {
            $insuranceCompany = InsuranceCompany::where('Name', $value->Company)->value('Expected');

            if ($insuranceCompany !== null) {
                $insurancePayment += ($totalPrice * $insuranceCompany) / 100;
            }
        }
        $patientBalance = $totalPrice - $insurancePayment;

        $tp->TotalBalance = $totalPrice;
        $tp->PatientBalance = $patientBalance;
        $tp->InsBalance = $insurancePayment;
        $tp->save();

        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        return view('PatientDetail', compact('doctor', 'pati', 'pt', 'not', 'st', 'dp', 'tp', 'act', 'userName', 'drs', 'da', 'noti', 'Orders', 'predefinedNotes', 'PatInsurance', 'icd9', 'icd10', 'diagnosis', 'copayment', 'invoiceForm', 'taxes'));
    }


    public function PatientList()
    {
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        $userId = FacadesSession::get('LoginId');
        extract(Patients::fetchPatients($userId, $userView));
        $pat = Patients::orderBy('created_at', 'desc')
            ->select('Off_Name', 'User', 'Dept', 'Order_Status', 'id', 'name', 'last_Name', 'Item', 'Dob', 'listed', 'created_at')
            ->paginate(5);
        $dp = Departments::select('Department', 'id')->get();
        $users = Users::find($userId);

        return view('PatientList', compact('drs', 'st', 'dp', 'pt', 'pat', 'users', 'noti'));
    }

    public function AllPatientList()
    {
        try {
            $additionalPat = Patients::orderBy('created_at', 'desc')->skip(50)->take(PHP_INT_MAX)->get(); // Use pagination
            return view('partials.patientListPartials', compact('additionalPat'))->render();
        } catch (\Exception $e) {
            // Log::error('Error loading additional patients: ' . $e->getMessage());
            return response()->json(['error' => 'Error loading additional patients.'], 500);
        }
    }



    public function OrderList()
    {
        $pat = Patients::orderBy('created_at', 'desc')->get();
        $dp = Departments::all();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('orders', compact('drs', 'st', 'dp', 'pt', 'noti', 'pat'));
    }





    public function UpdatePatient($id, Request $request)
    {
        $patient = Patients::findOrFail($id);
        $activity = new Activity();
        $activity->PtId = $id;
        $activity->name = FacadesSession::get('LoginName');
        $hasChanges = false;
        $shouldReassignUser = false;
        $us = $patient->User;
        $dept = $patient->Dept;

        //Check Status validation
        if ($patient->Order_Status != $request->st) {
            $checks = $request->options;
            $documents = documents::where('ptName', $id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy('docType');

            if ($request->st == "13") {
                if (isset($documents['Prescription (RX)'])) {
                    $latestPrescription = $documents['Prescription (RX)']->first();
                    if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                        return back()->with('error', 'The expiry date for Prescription (RX) is invalid.');
                    }
                } else {
                    return back()->with('error', 'No Prescription (RX) document found.');
                }
                if (isset($documents['CMN'])) {
                    $latestPrescription = $documents['CMN']->first();
                    if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                        return back()->with('error', 'The expiry date for CMN is invalid.');
                    }
                }

                if (in_array('Auth Required', $checks)) {
                    if (isset($documents['Authorization'])) {
                        $latestPrescription = $documents['Authorization']->first();
                        if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                            return back()->with('error', 'The expiry date for Authorization is invalid.');
                        }
                    } else {
                        return back()->with('error', 'No Authorization document found.');
                    }
                }

                if (!isset($documents['Office Notes/Medical Records'])) {
                    return back()->with('error', 'No Office Notes/Medical Records document found.');
                }
            }

            if ($request->st == "13" && ($request->dpt === "5" || $patient->Dept == "5")) {
                if (in_array('Sleep Study', $checks)) {
                    if (isset($documents['Sleep Study'])) {
                    } else {
                        return back()->with('error', 'No Sleep Study document found.');
                    }
                }
            }

            if ($request->st == "12" && ($request->dpt == "4" || $patient->Dept == "4")) {
                if (!isset($documents['Office Notes/Medical Records'])) {
                    return back()->with('error', 'No Office Notes/Medical Records document found.');
                }
                if (isset($documents['Consignment Documents'])) {
                    $latestPrescription = $documents['Consignment Documents']->first();
                    if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                        return back()->with('error', 'The RX date for Consignment department is Expired.');
                    }
                } else {
                    return back()->with('error', 'No Consignment document found.');
                }
            }

            if (($request->st == "12" || $request->st == "16") && $request->dpt == "4" && $patient->Dept == "4") {

                if (isset($documents['Consignment Documents'])) {
                    $latestPrescription = $documents['Consignment Documents']->first();
                    if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                        return back()->with('error', 'The RX date for Consignment department is Expired.');
                    }
                } else {
                    return back()->with('error', 'No Consignment document found.');
                }

                if (!isset($documents['Office Notes/Medical Records'])) {
                    return back()->with('error', 'No Office Notes/Medical Records document found.');
                }
            }

            if (($request->st == "12" || $request->st == "16") && ($request->dpt != "4" && $patient->Dept != "4")) {
                // dd('Working please wait....');
                if (isset($documents['Prescription (RX)'])) {
                    $latestPrescription = $documents['Prescription (RX)']->first();
                    if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                        return back()->with('error', 'The expiry date for Prescription (RX) is invalid.');
                    }
                } else {
                    return back()->with('error', 'No Prescription (RX) document found.');
                }

                if (!isset($documents['Office Notes/Medical Records'])) {
                    return back()->with('error', 'No Office Notes/Medical Records document found.');
                }
                if ($request->st == "12") {
                    if (isset($documents['Proof of Delivery'])) {
                        $latestPrescription = $documents['Prescription (RX)']->first();
                        if (Carbon::parse($latestPrescription->toDate)->isPast()) {
                            return back()->with('error', 'The expiry date for Prescription (RX) is invalid.');
                        }
                    } else {
                        return back()->with('error', 'No Proof of Delivery document found.');
                    }
                }
            }
        }

        // Check for department change
        if ($patient->Dept != $request->dpt) {
            $hasChanges = true;
            $previousDept = Departments::find($patient->Dept);
            $newDept = Departments::findOrFail($request->input('dpt'));
            $patient->Dept = $newDept->id;
            $shouldReassignUser = true;

            if (str_contains(strtolower($newDept->Department), 'resupply')) {
                $patient->resupplyCat = $request->subdpt;
            } else {
                $patient->resupplyCat = null;
            }

            $activity->message = "Change Department From {$previousDept->Department} to {$newDept->Department}";
        }

        $newDept = Departments::findOrFail($request->input('dpt'));
        if (str_contains(strtolower($newDept->Department), 'resupply') && $patient->resupplyCat != $request->subdpt) {
            $hasChanges = true;
            $activity->message = "Change Sub Department Of Resupply Department From {$patient->resupplyCat} to {$request->subdpt}";
            $patient->resupplyCat = $request->subdpt;
        }

        //Same Department
        if ($patient->Dept == $request->dpt) {
            $hasChanges = true;
        }

        // Check for status change
        if ($patient->Order_Status != $request->st) {


            $hasChanges = true;
            $previousStatus = Status::find($patient->Order_Status);
            $newStatus = Status::findOrFail($request->input('st'));
            $patient->Order_Status = $newStatus->id;
            $patient->User = $us;

            if (str_contains(strtolower($newStatus->Status), 'ready for dispense')) {
                $pt = Patients::findOrFail($id);
                $pt->checks = json_encode($request->options);
                $na = FacadesSession::get('LoginName');
                $pt->checksUser = $na;
                $pt->checksDate = now();
                $pt->save();
            }
            if (str_contains(strtolower($newStatus->Status), 'resupply')) {
                $request->validate(['redate' => 'required']);
                $patient->resupplyDate = Carbon::createFromFormat('Y-m-d',  $request->redate)->format('Y-m-d');
                $patient->new_date = Carbon::createFromFormat('Y-m-d',  $request->newredate)->format('Y-m-d');
                $patient->newdept = $request->newdpt;
                $patient->new_frequency = $request->newfrequency;
            }

            $PreviouStatusName = $previousStatus->Status ?? 'Pending';

            $activity->message .= isset($activity->message) ? " and Change Status From {{ $PreviouStatusName }}  to {$newStatus->Status}" : "Change Status From {{ $PreviouStatusName }} to {$newStatus->Status}";
            $data = [
                'patient_name' => $patient->name . " " . $patient->last_Name,
                'from_status' => $PreviouStatusName,
                'added_by' => FacadesSession::get('LoginName'),
                'assigned_users' => '',
                'to_status' => $newStatus->Status, // Ensure this is an array
                'ptId' => $id,
                'assign' => $patient->User,
                'UserID' => $patient->User,
            ];

            $this->notify('patient_status_change', $data);
        }

        $newStatus = Status::findOrFail($request->input('st'));
        if (str_contains(strtolower($newStatus->Status), 'resupply') && ($patient->resupplyDate != $request->redate || $patient->new_date != $request->newredate || $patient->newdept != $request->newdpt
            || $patient->new_frequency != $request->newfrequency)) {
            $hasChanges = true;
            $request->validate(['redate' => 'required']);
            $date = Carbon::createFromFormat('Y-m-d',  $request->redate)->format('m/d/Y');
            $activity->message = "Change Resupply Date From {$patient->resupplyDate} to {$date}";
            $patient->resupplyDate = Carbon::createFromFormat('Y-m-d',  $request->redate)->format('Y-m-d');
            $patient->new_date = Carbon::createFromFormat('Y-m-d',  $request->newredate)->format('Y-m-d');
            $patient->newdept = $request->newdpt;
            $patient->new_frequency = $request->newfrequency;
        }

        if ($request->filled('user')) {
            $patient->User = $request->user;
            $shouldReassignUser = false;
        } elseif ($shouldReassignUser) {
            $userIdWithLeastPatients = $this->assignLeastBusyUser($request->input('dpt'));
            if ($userIdWithLeastPatients) {
                $patient->User = $userIdWithLeastPatients;
            }
        }
        if ($hasChanges) {
            $patient->updated_at = now();
            $patient->save();
            $userR = FacadesSession::get('LoginRole');
            $userid = FacadesSession::get('LoginId');

            if ($dept != $request->dpt || $us != $patient->User) {
                $messageParts = []; // Initialize an array to hold parts of the message

                // User change message part
                if ($us != $patient->User) {
                    $preUser = Users::find($us);
                    $newUser = Users::find($patient->User);
                    $data = [
                        'patient_name' => $patient->name . " " . $patient->last_Name,
                        'from_user' => $preUser?->name,
                        'added_by' => FacadesSession::get('LoginName'),
                        'assigned_users' => $newUser->email,
                        'to_user' => $newUser->name, // Ensure this is an array
                        'ptId' => $id,
                        'assign' => $patient->User,
                        'UserID' => $patient->User,
                    ];

                    $this->notify('patient_user_change', $data);
                    $newDept1 = Departments::find($request->dpt);
                    $messageParts[] = "Changed user from {$preUser->name} to {$newUser->name} in {$newDept1->Department}";
                }

                // Department change message part
                if ($dept != $request->dpt) {
                    $newUser = Users::find($patient->User);
                    $previousDept = Departments::find($dept);
                    $newDept = Departments::find($request->dpt);
                    $st = Status::find($request->input('st'));
                    $data = [
                        'patient_name' => $patient->name . " " . $patient->last_Name,
                        'from_dept' => $previousDept->Department,
                        'added_by' => FacadesSession::get('LoginName'),
                        'assigned_users' => $newUser->email,
                        'to_dept' => $newDept->Department, // Ensure this is an array
                        'ptId' => $id,
                        'status' => $st->Status,
                        'assign' => $patient->User,
                        'UserID' => $patient->User,
                    ];

                    $this->notify('patient_Dept_change', $data);


                    $messageParts[] = "department from {$previousDept->Department} to {$newDept->Department}";
                }

                // Combine message parts and assign to activity message
                $activity->message = implode(" and ", $messageParts);

                $his =  new History();
                $his->PtName = $patient->name;
                $his->last_Name = $patient->last_Name;
                $his->UId = $userid;
                $his->DOB = $patient->Dob;
                $his->order_num = $patient->Order_No;
                $his->Acc_num = $patient->AccNumber;
                $his->Dept = $patient->Dept;
                $his->user = $patient->User;
                $his->status = $patient->Order_Status;
                $his->ptId = $patient->id;
                $his->save();
            }
            if ($userid != 3 && $userid != 7) {
                $activity->save();
            }

            if ($request->input('st') == 17 || $request->input('st') == 28 || $request->input('st') == 33) {
                $patient = Patients::findOrFail($id);
                $patient->request = 0;
                $patient->save();
            }

            $previousUrl = $request->input('previous_url');

            if (Str::contains($previousUrl, '/StatusPatient')) {
                return redirect()->to($previousUrl)->with('success', 'Patient updated successfully.');
            } else {
                return redirect()->to('/')->with('success', 'Patient updated successfully.');
            }
        }

        $previousUrl = $request->input('previous_url');

        if (Str::contains($previousUrl, '/StatusPatient')) {
            return redirect()->to($previousUrl)->with('success', 'Patient updated successfully.');
        } else {
            return redirect()->to('/')->with('success', 'Patient updated successfully.');
        }
    }


    protected function assignLeastBusyUser($deptId)
    {
        // Decode the JSON into an array, defaulting to an empty array if decoding fails or is not an array
        $viewOnlyDepts = json_decode(FacadesSession::get('LoginViewCheck'), true) ?: [];

        // Ensure $viewOnlyDepts is always an array to prevent errors
        if (!is_array($viewOnlyDepts)) {
            $viewOnlyDepts = [];
        }

        $users = Users::whereJsonContains('Dept', (string) $deptId)
            ->where('status', '0')
            ->where(function ($query) use ($deptId, $viewOnlyDepts) {
                $query->where('viewOnly', '!=', 'on')
                    // Safely use $viewOnlyDepts as it's ensured to be an array
                    ->orWhereNotIn('Dept', $viewOnlyDepts);
            })
            ->get();

        if ($users->isEmpty()) {
            return null;
        }
        $userPatientCounts = $users->mapWithKeys(function ($user) use ($deptId) {
            $patientCount = Patients::where('User', $user->id)
                ->where('Dept', $deptId)
                ->count();
            return [$user->id => $patientCount];
        });

        $minCount = $userPatientCounts->min();

        $usersWithMinCount = $userPatientCounts->filter(function ($count) use ($minCount) {
            return $count == $minCount;
        });


        return $usersWithMinCount->keys()->random();
    }


    public function EditPatientDetail($id, Request $request)
    {
        $request->validate([
            'item' => 'required',
            'DOB' => 'required',
            'address' => 'required',
            'insurance' => 'required',
            'office_name' => 'required',
            'order_status' => 'required',
            'department' => 'required',
            'name' => 'required',
            'AccNumber' => 'required',
        ]);

        $st = Patients::find($id);
        $st->name = $request->name;
        $st->Item = $request->item;
        $st->Off_Name = $request->office_name;
        $st->Dob = Carbon::createFromFormat('Y-m-d', $request->DOB)
            ->format('m/d/Y');
        $st->Location = $request->address;
        $st->Insurance = $request->insurance;
        $st->Order_No = $request->orderNumber;
        $st->Order_Status = $request->order_status ?? "1";
        $st->Dept = $request->department;
        $st->AccNumber = $request->AccNumber;
        $st->last_Name = $request->lastname;
        $st->gender = $request->gender;
        $st->height = $request->height;
        $st->weight = $request->weight;
        $st->p_mail = $request->mail;
        $st->p_phone = json_encode($request->phone);;


        if ($request->order_status === '5') {
            $request->validate([
                'redate' => 'required',
            ]);

            try {
                $st->resupplyDate = Carbon::createFromFormat('Y-m-d', $request->redate)->format('Y-m-d');
            } catch (Exception $e) {
                $st->resupplyDate = $request->redate;
            }

            try {
                $st->new_date = Carbon::createFromFormat('Y-m-d', $request->newredate)->format('Y-m-d');
            } catch (Exception $e) {
                $st->new_date = $request->newredate;
            }
            $st->newdept = $request->newdpt;
            $st->new_frequency = $request->newfrequency;
        }



        if (str_contains(strtolower($request->department), 'resupply')) {
            $request->validate([
                'subdpt' => 'required'
            ]);
            $st->resupplyCat = $request->subdpt;
        }

        if ($request->has('user')) {
            $st->User = $request->user;
        } else {
            $st->User = $this->assignLeastBusyUser($request->department);
        }


        $st->save();
        $us = users::find($st->User);
        $data = [
            'patient_name' => $request->name . " " . $request->lastname,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => $us->email, // Ensure this is an array
            'assigned' => $us->name, // Ensure this is an array
            'ptId' => $id,
            'UserID' => $us->id,
        ];

        $this->notify('edit_patient', $data);
        return redirect('PatientList')->with('success', '');
    }

    public function AddNote($id, Request $request)
    {
        $request->validate([
            'note' => 'required',
        ]);

        $no = new Notes();
        $no->name = FacadesSession::get('LoginName');
        $no->PtId = $id;
        $no->note = $request->note;
        $no->OrderID = $request->OrderID;
        $no->save();

        $ac = new Activity();
        $ac->PtId = $id;
        $ac->OrderID = $request->OrderID;
        $ac->name = FacadesSession::get('LoginName');
        $ac->message = "Note Added";
        $ac->save();

        $pt = Patients::find($id);
        $pt->updated_at = now();
        $pt->save();
        return back()->with('success', '');
    }

    public function DeletePatient($id)
    {
        $st = Patients::find($id);
        $st->delete();
        $user = users::find($st->User);
        $data = [
            'patient_name' => $st->name . " " . $st->last_Name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => $user->email, // Ensure this is an array
            'assigned' => $user->name, // Ensure this is an array
            'ptId' => $st->ptName,
            'assign' => $st->User,
            'UserID' => $id,
        ];

        $this->notify('delete_patient', $data);
        return back();
    }

    public function RegisterPatient(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'DOB' => 'required',
            'address' => 'required',
            'insurance' => 'required',
            'office_name' => 'required',
            'order_status' => 'required',
            'department' => 'required',
            'name' => 'required',
            'AccNumber' => 'required',
        ]);
        $dateInput = $request->input('DOB');
        $st = new Patients();
        $st->name = $request->name;
        $st->middleName = $request->middleName;
        $st->Item = $request->item;
        $st->Off_Name = $request->office_name;
        $st->Dob = Carbon::createFromFormat('Y-m-d', $dateInput)
            ->format('m/d/Y');
        $st->Location = $request->address;
        $st->Insurance = $request->insurance;
        $st->Order_No = $request->orderNumber;
        $st->Order_Status = $request->order_status;
        $st->Dept = $request->department;
        $st->AccNumber = $request->AccNumber;
        $st->listed = FacadesSession::get('LoginName');
        $st->last_Name = $request->lastname;
        $st->gender = $request->gender;
        $st->height = $request->height;
        $st->weight = $request->weight;
        $st->p_mail = $request->mail;
        $st->p_phone = json_encode($request->phone);


        if ($request->order_status == '5') {
            $request->validate([
                'redate' => 'required',
            ]);
            $st->resupplyDate = Carbon::createFromFormat('Y-m-d',  $request->redate)->format('Y-m-d');
            $st->new_date = Carbon::createFromFormat('Y-m-d',  $request->newredate)->format('Y-m-d');
            $st->newdept = $request->newdpt;
            $st->new_frequency = $request->newfrequency;
        }

        if (str_contains(strtolower($request->department), 'resupply')) {
            $request->validate([
                'subdpt' => 'required',
            ]);
        }
        $st->resupplyCat = $request->subdpt;

        if ($request->has('user')) {
            $st->User = $request->user;
        } else {
            $selectedDeptId = $request->input('department');
            $selectedStatus = $request->input('order_status');
            $userIdWithLeastPatients = $this->assignLeastBusyUser($selectedDeptId);
            if ($userIdWithLeastPatients) {
                $st->User = $userIdWithLeastPatients;
            }
        }

        $lastPat = Patients::orderBy('created_at', 'desc')->first(['id']);

        if ($request->has('CheckDocUpload')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'img' => 'required|file',
                ],
                [
                    'title.required' => 'Document Title is required.',
                    'img.required' => 'Image is required.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput()->with('error', 'Please fill required fields.');
            }

            $dc = new documents();
            $dc->docType = $request->docs;
            $dc->subDocType = $request->subDoc;
            $dc->title = $request->title;
            $dc->type = $request->type;
            $dc->desc = $request->desc;
            $dc->ptDr = $request->office_name;
            $dc->ptAcc = $request->AccNumber;
            $dc->ptOrder = $request->orderNumber;

            if ($request->filled('PFDate') || $request->docs == "Proof of Delivery") {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'PFDate' => 'required',
                    ],
                    [
                        'PFDate.required' => 'Date Of Service is required.',
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput()->with('error', 'Date of service is required.');
                }

                $dc->fromDate = $request->PFDate;
            } elseif ($request->filled('DOS') || $request->docs == "Consignment Documents") {

                $validator = Validator::make(
                    $request->all(),
                    [
                        'DOS' => 'required',
                        'FDate' => 'required',
                        'TDate' => 'required',
                    ],
                    [
                        'DOS.required' => 'Date Of Service is required.',
                        'FDate.required' => 'From Prescription RX Date Date is required.',
                        'TDate.required' => 'TO Prescription RX Date Date is required.',
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput()->with('error', 'Date of service and Prescription RX Date  Date is required.');
                }

                $dc->DOS = $request->DOS;
                $dc->fromDate = $request->FDate;
                $dc->toDate = $request->TDate;
            } elseif ($request->docs == "Prescription (RX)" || $request->docs == "Authorization" || $request->docs == "CMN") {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'FDate' => 'required',
                        'TDate' => 'required',
                    ],
                    [
                        'FDate.required' => $request->docs == 'Authorization' ? 'From Authorization Date is required.' : 'From Prescription RX Date is required.',
                        'TDate.required' => $request->docs == 'Authorization' ? 'To Authorization Date is required.' : 'To Prescription RX Date is required.',

                    ]
                );

                if ($validator->fails()) {
                    if ($request->docs == "Authorization") {
                        return back()->withErrors($validator)->withInput()->with('error', 'Authorization Date is required.');
                    }
                    return back()->withErrors($validator)->withInput()->with('error', 'Prescription RX Date is required.');
                }


                $dc->fromDate = $request->FDate;
                $dc->toDate = $request->TDate;
            }

            $dc->freq = $request->duration;
            $dc->upload = FacadesSession::get('LoginName');

            $second  = $request->img;
            $imagename1 = date('Y-m-d-His') . time() . '.' . $second->getClientOriginalExtension();
            $request->img->move('documents', $imagename1);
            $dc->img = $imagename1;
            $st->save();
            $lastID = Patients::orderBy('created_at', 'desc')->first(['id']);
            $lastOrder = documents::orderBy('created_at', 'desc')->first(['Order_No']);
            if ($lastOrder->Order_No != null) {
                $doc = $lastOrder->Order_No + 1;
            } else {
                $doc = 10001;
            }
            $dc->Order_No = $doc;
            $dc->ptName = $lastID->id;
            $dc->save();
        } else {
            $st->save();
        }

        $user = Users::find($st->User);
        $data = [
            'patient_name' => $request->name . " " . $request->lastname,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => $user->email, // Ensure this is an array
            'assigned' => $user->name, // Ensure this is an array
            'checkUpload' => $request->CheckDocUpload, // Ensure this is an array
            'document_type' => $request->docs,
            'ptId' => $lastPat->id,
            'assign' => $st->User,
            'UserID' => $user->id,
        ];

        $this->notify('add_new_patient', $data);

        return Redirect::to('PatientAdd')->with('success', '');
    }

    // Patient Section Ends

    // Department Section Start

    public function AddDepart()
    {
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('AddDepart', compact('drs', 'st', 'pt', 'noti'));
    }

    public function editDepart($id)
    {
        $s = Departments::find($id);
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        return view('editDept', compact('s', 'drs', 'st', 'pt', 'noti'));
    }

    public function DepartList()
    {
        $dept = Departments::orderBy('created_at', 'desc')->get();
        // $dr = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));

        return view('DeptList', compact('drs', 'dept', 'st', 'pt', 'noti'));
    }



    public function EditDepartDetail($id, Request $request)
    {
        $request->validate([
            'Department' => 'required',
        ]);
        $st = Departments::find($id);
        $st->Department = $request->Department;
        $st->save();
        return redirect('DepartmentList')->with('success', '');
    }

    public function DeleteDepart($id)
    {
        $st = Departments::find($id);
        $st->delete();
        return back();
    }

    public function RegisterDepart(Request $request)
    {
        $request->validate([
            'Department' => 'required',
        ]);
        $st = new Departments();
        $st->Department = $request->Department;
        $st->save();
        return redirect::to('DepartmentList')->with('success', '');
    }

    // Department Section Ends





    // Status Section Start

    public function AddStatus()
    {
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('AddStatus', compact('drs', 'st', 'pt', 'noti'));
    }

    public function editStatus($id)
    {
        $s = Status::find($id);
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('editstatus', compact('st', 'drs', 's', 'pt', 'noti'));
    }

    public function StatusList()
    {
        $sat = Status::orderBy('created_at', 'desc')->get();
        $dr = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('StatusList', compact('drs', 'dr', 'st', 'pt', 'sat', 'noti'));
    }

    public function EditStatusDetail($id, Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $st = Status::find($id);
        $st->Status = $request->status;
        $st->save();
        return redirect('StatusList')->with('success', '');
    }

    public function DeleteStatus($id)
    {
        $st = Status::find($id);
        $st->delete();
        return back();
    }

    public function RegisterStatus(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $st = new Status();
        $st->Status = $request->status;
        $st->save();
        return redirect::to('StatusList')->with('success', '');
    }

    // Status Section Ends



    // Doctors Section Start

    public function AddDoctor()
    {
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('AddDoctor', compact('drs', 'st', 'pt', 'noti'));
    }

    public function RegisterDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'fax' => 'required'
        ]);
        $dc = new Doctors();
        $dc->Office_Name = $request->name;
        $dc->Phone_Num = $request->number;
        $dc->Fax = $request->fax;
        $dc->save();
        $data = [
            'doctor_name' => $request->name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => "", // Ensure this is an array
            'assigned' => "", // Ensure this is an array
            'ptId' => "",
        ];

        $this->notify('add_new_doctor', $data);

        return redirect::to('DoctorList')->with('success', '');
    }

    public function DoctorList()
    {
        $doctor = Doctors::orderBy('created_at', 'desc')->get();
        $dr = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('DoctorOfficeList', compact('drs', 'doctor', 'dr', 'st', 'pt', 'noti'));
    }

    public function DeleteDoctor($id)
    {
        $user = Doctors::find($id);
        $user->delete();
        $data = [
            'doctor_name' => $user->Office_Name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => "", // Ensure this is an array
            'assigned' => "", // Ensure this is an array
            'ptId' => "",
        ];

        $this->notify('delete_doctor', $data);
        return back();
    }

    public function EditDoctor($id)
    {
        $dc = Doctors::find($id);
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('editDoctor', compact('dc', 'drs', 'st', 'pt', 'noti'));
    }

    public function EditDoctorDetail($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'fax' => 'required'
        ]);
        $dc =  Doctors::find($id);
        $dc->Office_Name = $request->name;
        $dc->Phone_Num = $request->number;
        $dc->Fax = $request->fax;
        $dc->save();
        $data = [
            'doctor_name' => $dc->Office_Name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => "", // Ensure this is an array
            'assigned' => "", // Ensure this is an array
            'ptId' => "",
        ];

        $this->notify('edit_doctor', $data);
        return redirect('DoctorList')->with('success', 'You Have Registered successfully');
    }

    // Doctor Section End





    //User Section Start

    public function AddUser()
    {
        $dep = Departments::all();
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');

        extract(Patients::fetchPatients($userId, $userView));

        return view('AddUser', compact('dep', 'drs', 'st', 'pt', 'noti'));
    }


    public function FilteredUserPatient($id, $Stid)
    {
        $user = Users::find($id);
        $pat = Patients::where([['User', $id], ['Order_Status', $Stid]])->orderBy('created_at', 'desc')->get('*');
        $tdpCount = Patients::where('User', $id)->whereDate('created_at', '=', now()->toDateString())->count();
        $tpCount = $pat->count();

        $dr = Patients::where('User', $id)->orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $hc = History::where('UId', $id)->orderBy('created_at', 'desc')->count();
        $his = History::where('UId', $id)->orderBy('created_at', 'desc')->get();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('userDetail', compact('user', 'pat', 'drs', 'tpCount', 'tdpCount', 'dr', 'st', 'pt', 'hc', 'his', 'noti'));
    }



    public function userDetail($id)
    {
        $user = Users::find($id);
        $pat = Patients::where('User', $id)->orderBy('created_at', 'desc')->get('*');
        $tdpCount = Patients::where('User', $id)->whereDate('created_at', '=', now()->toDateString())->count();
        $tpCount = $pat->count();

        $dr = Patients::where('User', $id)->orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $hc = History::where('UId', $id)->orderBy('created_at', 'desc')->count();
        $his = History::where('UId', $id)->orderBy('created_at', 'desc')->get();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('userDetail', compact('user', 'pat', 'drs', 'tpCount', 'tdpCount', 'dr', 'st', 'pt', 'hc', 'his', 'noti'));
    }

    public function UserList()
    {
        $users = Users::orderBy('created_at', 'desc')->get();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('userList', compact('users', 'drs', 'st', 'pt', 'noti'));
    }

    public function EditUser($id)
    {
        $user = Users::find($id);
        $dep = Departments::all();
        $drs = Patients::orderBy('created_at', 'desc')->get();
        $st = Status::all();
        $pt =  Patients::count();
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('editUser', compact('user', 'dep', 'drs', 'st', 'pt', 'noti'));
    }

    public function RegisterUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'mail' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8', // minimum length 8 characters
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->mail;
        $user->role = $request->role;
        $user->userViewPermisiion = $request->viewUser;
        if ($request->has('permissionCheckbox')) {
            $user->permission = json_encode($request->permission);
        }

        if ($request->role == "0") {
            $user->max_pending_order = $request->max_order;
            $user->Dept = json_encode($request->dept);
            $user->add = $request->addPt;
            $user->edit = $request->editPt;
            $user->delete = $request->deletePt;
        } else {
            $user->Dept = null;
            $user->add = null;
            $user->edit = null;
            $user->delete = null;
        }
        $user->cancel = $request->cancelPt;
        $user->BulkPer = $request->bulkPer;
        $user->close = $request->closePt;
        $user->hold = $request->holdPt;
        $user->editDocs = $request->editDoc;
        $user->deleteDocs = $request->deleteDoc;
        $user->progress = $request->progressCheck;
        $user->password = Hash::make($request->password);
        $user->ChangePassword = 0;
        $user->viewOnly = $request->viewCheck;
        $user->ViewDept = json_encode($request->Vdept);
        $user->save();
        if ($request->role == "0" || $request->role == "1") {
            $data = [
                'user_name' => $request->name,
                'added_by' => FacadesSession::get('LoginName'),
                'assigned_users' => "", // Ensure this is an array
                'assigned' => "", // Ensure this is an array
                'ptId' => "",
            ];

            $this->notify('add_new_user', $data);
        }
        return redirect::to('UserAdd')->with('success', 'You Have Registered successfully');
    }

    public function EditUserDetail($id, Request $request)
    {
        $user = Users::find($id);
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'mail' => 'required|email|',

        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:8', // minimum length 8 characters
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],
            ]);
            $user->password = Hash::make($request->password);
            $user->ChangePassword = 1;
        }

        $user->name = $request->name;
        $user->email = $request->mail;
        $user->role = $request->role;
        $user->viewOnly = $request->viewCheck;
        $user->userViewPermisiion = $request->viewUser;
        if ($request->role == "0") {
            $user->max_pending_order = $request->max_order;
            $user->Dept = json_encode($request->dept);
            $user->add = $request->addPt;
            $user->edit = $request->editPt;
            $user->delete = $request->deletePt;
        } else {
            $user->Dept = null;
            $user->add = null;
            $user->edit = null;
            $user->delete = null;
        }
        $user->BulkPer = $request->bulkPer;
        $user->cancel = $request->cancelPt;
        $user->close = $request->closePt;
        $user->hold = $request->holdPt;

        $user->editDocs = $request->editDoc;
        $user->deleteDocs = $request->deleteDoc;

        $user->progress = $request->progressCheck;
        $user->viewOnly = $request->viewCheck;
        $user->add = $request->addPt;
        $user->edit = $request->editPt;
        $user->delete = $request->deletePt;
        $user->ViewDept = json_encode($request->Vdept);
        if ($request->has('permissionCheckbox')) {
            $user->permission = json_encode($request->permission);
        }

        $user->save();

        // if ($request->role == "0" || $request->role == "1") {
        $data = [
            'user_name' => $request->name,
            'depart' => $request->dept,
            'added_by' => FacadesSession::get('LoginName'),
            'DeptChange' => $request->dept != $user->Dept ? "yes" : "no",
            'assigned_users' => $request->mail, // Ensure this is an array
            'assigned' => $request->name, // Ensure this is an array
            'ptId' => "",
            'UserID' => $id,
        ];

        $this->notify('edit_user', $data);
        // }

        return redirect('UserList')->with('success', 'You Have Registered successfully');
    }

    public function DeleteUser($id)
    {
        $user = Users::find($id);
        $user->delete();
        $data = [
            'user_name' => $user->name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => "", // Ensure this is an array
            'assigned' => "", // Ensure this is an array
            'ptId' => "",
        ];

        $this->notify('delete_user', $data);
        return back();
    }

    public function BanUser($id)
    {
        $log = new Logs();
        $user = Users::find($id);
        if ($user->status == "1") {
            $user->status = "0";
            $log->Action = "UnBan user";
        } else {
            $user->status = "1";
            $log->Action = "Ban user";
            $data = [
                'user_name' => $user->name,
                'added_by' => FacadesSession::get('LoginName'),
                'assigned_users' => "", // Ensure this is an array
                'assigned' => "", // Ensure this is an array
                'ptId' => "",
            ];

            $this->notify('ban_user', $data);
        }
        $user->save();



        $log->UserId = FacadesSession::get('LoginId');
        $log->UserName = FacadesSession::get('LoginName');
        $userid = FacadesSession::get('LoginId');
        if ($userid != 3 && $userid != 7) {
            $log->save();
        }
        return back();
    }

    //User Section Ends




    public function ChangePassword()
    {
        $st = Status::all();
        $dp = Departments::all();
        $userR = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        if ($userR ==  "0") {
            $userd = FacadesSession::get('LoginDept');
            $deptIds = json_decode($userd, true) ?? [];
            $query = Patients::whereIn('Dept', $deptIds)->orderBy('created_at', 'desc');
            if ($userView != 'on') {
                $query = $query->where('User', $userId);
            }
            $drs = $query->get();
            $pt =  $drs->count();
        } else {
            $pt =  Patients::count();
            $drs = Patients::orderBy('created_at', 'desc')->get();
        }
        $users = Users::find($userId);
        $userId = FacadesSession::get('LoginId');
        $userView = FacadesSession::get('LoginViewCheck');
        extract(Patients::fetchPatients($userId, $userView));
        return view('changePassword', compact('drs', 'st', 'pt', 'noti'));
    }


    public function OTPVerify()
    {
        return view('verifyOTP');
    }

    public function forgetPassword()
    {
        return view('forgetPassword');
    }

    public function login()
    {
        return view('login');
    }

    public function OneTimePassword()
    {
        return view('changePasswordFirst');
    }

    public function VerifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:5'
        ]);
        $userCode = FacadesSession::get('LoginCode');
        $userCheck = FacadesSession::get('LoginPasswordCheck');
        if ($request->otp == $userCode) {
            Session()->put('functions_called_after_login', false);
            $log = new Logs();
            $log->Action = "Logged in Successfully";
            $log->UserId = FacadesSession::get('LoginId');
            $log->UserName = FacadesSession::get('LoginName');
            $userid = FacadesSession::get('LoginId');
            $userR = FacadesSession::get('LoginRole');
            if ($userid != 3 && $userid != 7) {
                $log->save();
            }
            if ($userR == "0" || $userR == "1") {
                $data = [
                    'user_name' => "Login",
                    'added_by' => FacadesSession::get('LoginName'),
                    'assigned_users' => FacadesSession::get('LoginMail'), // Ensure this is an array
                    'assigned' => "", // Ensure this is an array
                    'ptId' => "",
                ];

                $this->notify('Auth', $data);
            }
            if ($userCheck == 1) {
                session()->put('Verified', $userCode);
                return redirect('/');
            } else {
                return redirect('changedPasswordFirst');
            }
        } else {
            return back()->with('fail', 'You Have');
        }
    }


    public function LoginUser(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $user = Users::where('email', '=', $request->mail)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->status == "0") {
                    $this->setSessionValues($user);
                    $code = mt_rand(10000, 99999);
                    $user->loginCode = $code;
                    $user->save();
                    $request->session()->put('LoginUserCode', $code);
                    session()->put('retrySessionCheck', $code);
                } else {
                    return back()->with('Ban', 'Account Banned');
                }
                return redirect('AuthMail');
            } else {
                return back()->with('fail', 'Password not match');
            }
        } else {
            return back()->with('fail', 'E-Mail not registered');
        }
        return back()->with('success', 'You Have Login successfully');
    }

    public function logout()
    {
        $log = new Logs();
        $log->Action = "Logged Out";
        $log->UserId = FacadesSession::get('LoginId');
        $userR = FacadesSession::get('LoginRole');
        $log->UserName = FacadesSession::get('LoginName');
        $userid = FacadesSession::get('LoginId');
        if ($userid != 3 && $userid != 7) {
            $log->save();
        }
        if ($userR == "0" || $userR == "1") {
            $data = [
                'user_name' => "Logout",
                'added_by' => FacadesSession::get('LoginName'),
                'assigned_users' => FacadesSession::get('LoginMail'), // Ensure this is an array
                'assigned' => "", // Ensure this is an array
                'ptId' => "",
            ];

            $this->notify('Auth', $data);
        }

        if (session()->has('LoginId')) {
            session()->flush();
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
        }
        return redirect::to('/');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'mail' => 'required|email',
        ]);

        $user = Users::where('email', '=', $request->mail)->first();
        if ($user) {
            $uniquePassword = $this->generateStrongPassword();
            session()->put('NewPassowrd', $uniquePassword);
            $user->password = Hash::make($uniquePassword);
            $user->ChangePassword = 0;
            $user->save();
            $mail = new PHPMailer(true);
            try {
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->SMTPDebug = 0; // Disable verbose debug output
                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = 'smtp.stackmail.com';
                $mail->Username   = 'otpverification@healthcaredme.com';
                $mail->Password   = 'Subhan@dg41rq@$';
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->CharSet = 'UTF-8';
                $mail->Port       = 587;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true // Changed to true since you're disabling peer verification
                    )
                );                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                $mail->setFrom('support@healthcaredme.com', 'Health Care New Updated Password');
                $mail->addAddress($request->mail);
                //Content
                $mail->Subject = 'Updated Password';
                $mail->isHTML(true);
                $mail->Body = '
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 20px;
                            background-color: #f4f4f4;
                        }
                        .container {
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 5px;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                            max-width: 600px;
                            margin: 40px auto;
                            text-align: center;
                        }
                        .code {
                            font-size: 24px;
                            margin: 20px 0;
                            padding: 10px;
                            border: 1px solid #ddd;
                            background-color: #f9f9f9;
                            display: inline-block;
                            font-weight: bold;
                        }
                        .footer {
                            margin-top: 20px;
                            font-size: 12px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h2>Your Verification Code</h2>
                        <p> Please enter the following Password to Login your Account.</p>
                        <div class="code">' . $uniquePassword . '</div>
                        <p class="footer">If you did not request this code, please ignore this email.</p>
                    </div>
                </body>
                </html>';


                $mail->send();
                return back();
            } catch (Exception $e) {
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return back();
            }
        } else {
            return back()->with('fail', '');
        }
    }








    public function UpdateChangePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8', // minimum length 8 characters
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);
        $userId = FacadesSession::get('LoginId');
        $user = Users::find($userId);
        $user->password = Hash::make($request->password);
        $user->save();

        $check = FacadesSession::get('Verified'); // This is equivalent to FacadesSession::get('Verified');

        if ($check) {
            $user = Users::find($userId);
            $user->ChangePassword = 0;
            $user->save();
        } else {
            $user = Users::find($userId);
            $user->ChangePassword = 1;
            $user->save();
            session()->put('Verified', '$userCode'); // Ensure you use the variable without quotes for its value.
        }

        $user->save();

        $log = new Logs();
        $log->Action = "Password Changed";
        $log->UserId = FacadesSession::get('LoginId');
        $log->UserName = FacadesSession::get('LoginName');
        $userid = FacadesSession::get('LoginId');
        if ($userid != 3 && $userid != 7) {
            $log->save();
        }
        $data = [
            'user_name' => $user->name,
            'added_by' => FacadesSession::get('LoginName'),
            'assigned_users' => $user->email, // Ensure this is an array
            'assigned' => $user->name, // Ensure this is an array
            'ptId' => "",
        ];

        $this->notify('change_password', $data);
        return redirect::to('/')->with('success', '');
    }




    public function AuthenticationMail()
    {
        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        // require 'vendor/autoload.php'; // Include Composer's autoloader

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output

            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true // Changed to true since you're disabling peer verification
                )
            );

            $userMail = FacadesSession::get('LoginMail');

            $mail->setFrom('support@healthcaredme.com', 'Health Care OTP Verification Code');
            $mail->addAddress($userMail);


            //Content
            $mail->Subject = 'Verification Code';
            $mail->isHTML(true);
            $code = mt_rand(10000, 99999);
            session()->put('LoginCode', $code);
            $mail->Body = '
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 20px;
                        background-color: #f4f4f4;
                    }
                    .container {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        max-width: 600px;
                        margin: 40px auto;
                        text-align: center;
                    }
                    .code {
                        font-size: 24px;
                        margin: 20px 0;
                        padding: 10px;
                        border: 1px solid #ddd;
                        background-color: #f9f9f9;
                        display: inline-block;
                        font-weight: bold;
                    }
                    .footer {
                        margin-top: 20px;
                        font-size: 12px;
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>Your Verification Code</h2>
                    <p>Thank you for registering. Please enter the following verification code to complete your registeration process.</p>
                    <div class="code">' . $code . '</div>
                    <p class="footer">If you did not request this code, please ignore this email.</p>
                </div>
            </body>
            </html>';


            $mail->send();
            fwrite($myfile, "\n" . 'msg sent successfully');
            fclose($myfile);
            return Redirect('OTPVerify')->with('success', 'You Have Registered successfully');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            fwrite($myfile, "\n" . $e);
            fclose($myfile);
            return back()->with('ban', 'You Have Registered successfully');
        }
    }





    public function HoldRequest($id)
    {
        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        // require 'vendor/autoload.php'; // Include Composer's autoloader

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output

            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true // Changed to true since you're disabling peer verification
                )
            );


            $mail->setFrom('support@healthcaredme.com', 'Health Care Update The Status To Hold');

            $holdUsers = Users::where('hold', '=', 'on')
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($holdUsers as $user) {
                $mail->addAddress($user->email);
            }


            //Content
            $mail->Subject = 'Request to Hold Patient Status';
            $mail->isHTML(true);
            $mail->Body = $this->requestMailBody($id);

            $mail->send();
            echo 'Message has been sent';
            fwrite($myfile, "\n" . 'msg sent successfully');
            fclose($myfile);

            // $users = users::where('email', $request->pr)->first();
            $ac = new Activity();
            $ac->PtId = $id;
            $ac->name = FacadesSession::get('LoginName');
            $ac->message = 'Requested to Change the status to Hold';
            $ac->save();
            $patient = Patients::find($id);
            $patient->request = 2;
            $patient->save();
            // $patient->requestedPerson = $users->id;

            $not = new Notifications();
            $not->PtId = $id;
            $not->Message = 'Requested to Change the status to Hold';
            $not->type = "Request to Hold";
            $not->UserId = $user->id;
            $not->UploadedBy = FacadesSession::get('LoginName');
            $not->save();


            return back()->with('success', 'You Have Requested successfully');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            fwrite($myfile, "\n" . $e);
            fclose($myfile);
            return back()->with('ban', 'You Have Registered successfully');
        }
    }

    public function ApproveRequest($id)
    {
        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        // require 'vendor/autoload.php'; // Include Composer's autoloader

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output

            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true // Changed to true since you're disabling peer verification
                )
            );

            $patient = Patients::find($id);
            $user = users::find($patient->User);
            $mail->addAddress($user->email);
            if ($patient->request == 2) {
                $patient->Order_Status = "33";
                $stName = "Hold";
            } elseif ($patient->request == 1) {
                $patient->Order_Status = "17";
                $stName = "Cancel";
            } else {
                $patient->Order_Status = "28";
                $stName = "Close";
            }

            $mail->setFrom('support@healthcaredme.com', 'Health Care Update The Status to' . $stName);


            //Content
            $mail->Subject = 'Request to ' . $stName . ' Patient Status Approved';
            $mail->isHTML(true);
            $mail->Body = $this->responseMailBody($id, 'approved');

            $mail->send();
            echo 'Message has been sent';
            fwrite($myfile, "\n" . 'msg sent successfully');
            fclose($myfile);

            // $users = users::where('email', $request->pr)->first();

            // $patient = Patients::find($id);

            $patient->request = 0;
            $patient->save();
            $ac = new Activity();
            $ac->PtId = $id;
            $ac->name = FacadesSession::get('LoginName');
            $ac->message = 'Request to Change the status to ' . $stName . ' is approved';
            $ac->save();
            // $patient->requestedPerson = $users->id;
            $not = new Notifications();
            $not->PtId = $id;
            $not->Message = "Your request to " . $stName . " for the patient " . $patient->name . " " . $patient->last_Name . " has been Approved";
            $not->type = "Request Approve";
            $not->UserId = $user->id;
            $not->UploadedBy = FacadesSession::get('LoginName');
            $not->save();

            return back()->with('success', 'Approved Requested successfully');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            fwrite($myfile, "\n" . $e);
            fclose($myfile);
            return back()->with('ban', 'You Have Registered successfully');
        }
    }

    public function RejectRequest($id)
    {
        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        // require 'vendor/autoload.php'; // Include Composer's autoloader

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );


            $patient = Patients::find($id);
            $user = users::find($patient->User);
            $mail->addAddress($user->email);
            if ($patient->request == 2) {
                // $patient->Order_Status = "33";
                $stName = "Hold";
            } elseif ($patient->request == 1) {
                // $patient->Order_Status = "17";
                $stName = "Cancel";
            } else {
                // $patient->Order_Status = "28";
                $stName = "Close";
            }

            $mail->setFrom('support@healthcaredme.com', 'Health Care Update The Status To ' . $stName);


            //Content
            $mail->Subject = 'Request to ' . $stName . ' Patient Status Rejected';
            $mail->isHTML(true);
            $mail->Body = $this->responseMailBody($id, 'rejected');

            $mail->send();
            echo 'Message has been sent';
            fwrite($myfile, "\n" . 'msg sent successfully');
            fclose($myfile);

            // $users = users::where('email', $request->pr)->first();

            // $patient = Patients::find($id);

            $patient->request = 0;
            $patient->save();
            $ac = new Activity();
            $ac->PtId = $id;
            $ac->name = FacadesSession::get('LoginName');
            $ac->message = 'Request to Change the status to ' . $stName . ' is rejected';
            $ac->save();
            // $patient->requestedPerson = $users->id;
            $not = new Notifications();
            $not->PtId = $id;
            $not->Message = "Your request to " . $stName . " for the patient " . $patient->name . " " . $patient->last_Name . " has been Rejected";
            $not->type = "Request Approve";
            $not->UserId = $user->id;
            $not->UploadedBy = FacadesSession::get('LoginName');
            $not->save();


            return back()->with('success', 'Rejected Requested successfully');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            fwrite($myfile, "\n" . $e);
            fclose($myfile);
            return back()->with('ban', 'You Have Registered successfully');
        }
    }



    public function CloseRequest($id)
    {

        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        // require 'vendor/autoload.php'; // Include Composer's autoloader

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output

            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true // Changed to true since you're disabling peer verification
                )
            );

            $userMail = FacadesSession::get('LoginMail');

            $mail->setFrom('support@healthcaredme.com', 'Health Care Update The Status To Close');
            $CloseUsers =  Users::where('close', 'on')->orderBy('created_at', 'desc')
                ->get();

            foreach ($CloseUsers as $user) {
                $mail->addAddress($user->email);
            }

            //Content
            $mail->Subject = 'Request to Close Patient Status';
            $mail->isHTML(true);
            $mail->Body = $this->requestMailBody($id);

            $mail->send();
            echo 'Message has been sent';
            fwrite($myfile, "\n" . 'msg sent successfully');
            fclose($myfile);

            // $users = users::where('email', $request->pr)->first();
            $ac = new Activity();
            $ac->PtId = $id;
            $ac->name = FacadesSession::get('LoginName');
            $ac->message = 'Requested to Change the status to CLose';
            $ac->save();
            $patient = Patients::find($id);
            $patient->request = 3;
            // $patient->requestedPerson = $users->id;
            $patient->save();

            $not = new Notifications();
            $not->PtId = $id;
            $not->Message = 'Requested to Change the status to Close';
            $not->type = "Request to Close";
            $not->UserId = $user->id;
            $not->UploadedBy = FacadesSession::get('LoginName');
            $not->save();

            return back()->with('success', 'You Have Requested successfully');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            fwrite($myfile, "\n" . $e);
            fclose($myfile);
            return back()->with('ban', 'You Have Registered successfully');
        }
    }




    public function CancelRequest($id)
    {
        $canUsers = Users::where('cancel', 'on')->orderBy('created_at', 'desc')
            ->get();

        $myfile = fopen("logs.txt", "a") or die("Unable to open file!");
        // require 'vendor/autoload.php'; // Include Composer's autoloader

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; // Disable verbose debug output

            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true // Changed to true since you're disabling peer verification
                )
            );

            $userMail = FacadesSession::get('LoginMail');

            $mail->setFrom('support@healthcaredme.com', 'Health Care Update The Status To Cancel');
            foreach ($canUsers as $user) {
                $mail->addAddress($user->email);
            }

            //Content
            $patient = Patients::find($id);
            $user = users::find($patient->User);
            $mail->Subject = 'Request to Cancel Patient Status';
            $mail->isHTML(true);
            $mail->Body = $this->requestMailBody($id);
            $mail->send();
            echo 'Message has been sent';
            fwrite($myfile, "\n" . 'msg sent successfully');
            fclose($myfile);

            $ac = new Activity();
            $ac->PtId = $id;
            $ac->name = FacadesSession::get('LoginName');
            $ac->message = 'Requested  to Change the status to cancel';
            $ac->save();
            $patient = Patients::find($id);
            $patient->request = 1;
            // $patient->requestedPerson = $users->id;
            $patient->save();

            $not = new Notifications();
            $not->PtId = $id;
            $not->Message = 'Requested to Change the status to Cancel';
            $not->type = "Request to Cancel";
            $not->UserId = $user->id;
            $not->UploadedBy = FacadesSession::get('LoginName');
            $not->save();

            return back()->with('success', 'You Have Requested successfully');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            fwrite($myfile, "\n" . $e);
            fclose($myfile);
            return back()->with('ban', 'You Have Registered successfully');
        }
    }



    protected function responseMailBody($id, $status)
    {
        $patient = Patients::find($id);
        $user = users::find($patient->User);

        // Determine message based on status
        $message = "";
        $subject = "";
        if ($status == 'approved') {
            $subject = "Patient Status Change Approved";
            $message = "<p>We are pleased to inform you that the request to change the status for <strong>{$patient->name} {$patient->last_Name}</strong> has been approved.</p>
                        <p>You can view the updated status by visiting the patient's profile at the link below:</p>";
        } else if ($status == 'rejected') {
            $subject = "Patient Status Change Rejected";
            $message = "<p>We regret to inform you that the request to change the status for <strong>{$patient->name} {$patient->last_Name}</strong> has been rejected.</p>
                        <p>If you have any questions or require further clarification, please do not hesitate to contact us.</p>";
        }

        $html = "
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 20px;
                            background-color: #f4f4f4;
                        }
                        .container {
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 8px;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.12);
                            max-width: 600px;
                            margin: 40px auto;
                            text-align: left;
                        }
                        h2 {
                            color: #333;
                            font-size: 24px;
                        }
                        p {
                            color: #555;
                            line-height: 1.5;
                            font-size: 16px;
                        }
                        a {
                            text-decoration: none;
                            color: #007BFF;
                            font-weight: bold;
                        }
                        a:hover {
                            text-decoration: underline;
                        }
                        .info {
                            background-color: #e8e8e8;
                            padding: 10px;
                            border-left: 5px solid #007BFF;
                            margin: 20px 0;
                            font-style: italic;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>{$subject}</h2>
                        {$message}
                        <div class='info'>
                            <p><strong>Patient First Name:</strong> {$patient->name}</p>
                            <p><strong>Patient Last Name:</strong> {$patient->last_Name}</p>
                        </div>
                        <p><a href='https://portal.healthcaredme.com/PatientDetail/{$patient->id}'>View Patient Details</a></p>
                    </div>
                </body>
                </html>";
        return $html;
    }



    protected function requestMailBody($id)
    {
        $patient = Patients::find($id);
        $user = users::find($patient->User);

        $html = "
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 20px;
                            background-color: #f4f4f4;
                        }
                        .container {
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 8px;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.12);
                            max-width: 600px;
                            margin: 40px auto;
                            text-align: left;
                        }
                        h2 {
                            color: #333;
                            font-size: 24px;
                        }
                        p {
                            color: #555;
                            line-height: 1.5;
                            font-size: 16px;
                        }
                        a {
                            text-decoration: none;
                            color: #007BFF;
                            font-weight: bold;
                        }
                        a:hover {
                            text-decoration: underline;
                        }
                        .info {
                            background-color: #e8e8e8;
                            padding: 10px;
                            border-left: 5px solid #007BFF;
                            margin: 20px 0;
                            font-style: italic;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>Request to Change Patient Status</h2>
                        <p>Hi, my name is {$user->name} and I am requesting a status change for the following patient.</p>
                        <div class='info'>
                            <p><strong>Patient First Name:</strong> {$patient->name}</p>
                            <p><strong>Patient Last Name:</strong> {$patient->last_Name}</p>
                        </div>
                        <p>For more details, please visit the patient's profile at the link below:</p>
                        <p><a href='https://portal.healthcaredme.com/PatientDetail/{$patient->id}'>View Patient Details</a></p>
                    </div>
                </body>
                </html>";
        return $html;
    }


    public function store(Request $request)
    {
        $log = new Logs();
        $log->Action = $request->action;
        $log->UserId = FacadesSession::get('LoginId');
        $log->UserName = FacadesSession::get('LoginName');
        $userid = FacadesSession::get('LoginId');
        $userid = FacadesSession::get('LoginId');
        if ($userid != 3 && $userid != 7) {
            $log->save();
        }

        return response()->json(['success' => 'Action logged successfully']);
    }


    public function CheckUserLogin()
    {
        session()->forget('retrySessionCheck');
        $userid = FacadesSession::get('LoginId');
        $us = Users::find($userid);
        session()->put('retrySessionCheck', $us->loginCode);
        return response()->json(['success' => 'User Code successfully']);
    }


    //Resuuply Patients Mail

    public function sendResupplyReminder()
    {
        $twentyFourHoursAgo = Carbon::now()->subHours(24);
        $userRole = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userEmail = FacadesSession::get('LoginMail');
        $userd = FacadesSession::get('LoginDept');
        $deptIds = json_decode($userd, true) ?? [];
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $user = Users::find(FacadesSession::get('LoginId'));


        if ($userRole != "0") {
            return;
        }

        if ($user->last_resupply_reminder_sent_at  && Carbon::parse($user->last_resupply_reminder_sent_at)->isToday()) {
            return response()->json(['message' => 'Resupply Reminder has already been sent today']);
        }
        $userDept = json_decode(FacadesSession::get('LoginDept'), true);
        $patients = Patients::whereIn('Dept', $userDept)
            ->where('User', $userId)
            ->where('Order_Status', '5')
            ->where('resupplyDate', '<=', $tomorrow)
            ->get();


        if ($patients->isEmpty()) {
            return; // No patients to send update reminder for.
        }

        $this->sendEmailWithPatients($patients, $userEmail, 'Health Care Resupply Patients List');
        $user->last_resupply_reminder_sent_at  = Carbon::now();
        $user->save();
        return response()->json(['message' => 'Resupply Reminder sent successfully']);
    }

    //Resupply Pateint mail end



    //Follow Up Mail
    public function sendUpdateReminder()
    {
        $twentyFourHoursAgo = Carbon::now()->subHours(24);
        $userRole = FacadesSession::get('LoginRole');
        $userId = FacadesSession::get('LoginId');
        $userEmail = FacadesSession::get('LoginMail'); // Assuming the email is stored in session

        $user = Users::find(FacadesSession::get('LoginId'));


        if ($userRole != "0") {
            return;
        }
        if ($user->last_reminder_sent_at && Carbon::parse($user->last_reminder_sent_at)->isToday()) {

            // if ($user->last_reminder_sent_at && $user->last_reminder_sent_at->isToday()) {
            return response()->json(['message' => 'Reminder has already been sent today']);
        }
        $userDept = json_decode(FacadesSession::get('LoginDept'), true);
        $patients = Patients::whereIn('Dept', $userDept)
            ->whereNotIn('Order_Status', [17, 18, 16, 5, 28])
            ->where('User', $userId)
            ->where('updated_at', '<=', $twentyFourHoursAgo)
            ->get();


        if ($patients->isEmpty()) {
            return; // No patients to send update reminder for.
        }

        $user->last_reminder_sent_at = Carbon::now();
        $user->save();
        $this->sendEmailWithPatients($patients, $userEmail, 'Health Care Follow Up Patients List');
        return response()->json(['message' => 'Reminder sent successfully']);
    }


    protected function sendEmailWithPatients($patients, $userEmail, $sub)
    {
        $mail = new PHPMailer(true);

        try {
            // Mailer configuration
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true // Changed to true since you're disabling peer verification
                )
            );

            $userMail = FacadesSession::get('LoginMail');

            $mail->setFrom('support@healthcaredme.com', $sub);
            $mail->addAddress($userMail);


            // Content
            $mail->isHTML(true);
            $mail->Subject = $sub;
            $mail->Body = $this->generateEmailBody($patients);

            $mail->send();
            echo 'Reminder has been sent.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    protected function generateEmailBody($patients)
    {
        $html = '<h2 style="font-family: Arial, sans-serif; color: #333;">Patients Pending Update</h2>';
        $html .= '<div style="overflow-x:auto;">';
        $html .= '<table style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; margin-bottom: 20px;">';
        $html .= '<thead style="background-color: #f2f2f2; text-align: left;">';
        $html .= '<tr style="border-bottom: 1px solid #ddd;">';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">No.</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">PT&nbsp;First&nbsp;Name</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">PT&nbsp;Last&nbsp;Name</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">Item</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">DOB</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">Account</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">Department</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">User</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">Status</th>';
        $html .= '<th style="padding: 8px; border-bottom: 2px solid #ddd;">Order&nbsp;Date</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $sno = 1;
        foreach ($patients as $pt) {
            $userName = \App\Models\Users::find($pt?->User)?->name ?? 'N/A';
            $deptName = \App\Models\Departments::find($pt?->Dept)?->Department ?? 'N/A';
            $statusName = \App\Models\Status::find($pt?->Order_Status)?->Status ?? 'N/A';

            $html .= '<tr style="border-bottom: 1px solid #ddd; cursor: pointer;" onclick="window.location=\'/PatientDetail/' . $pt->id . '\';">';
            $html .= '<td style="padding: 8px;">' . $sno++ . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($pt->name) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($pt->last_Name) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($pt->Item) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($pt->Dob) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($pt->AccNumber) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($deptName) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($userName) . '</td>';
            $html .= '<td style="padding: 8px;">' . htmlspecialchars($statusName) . '</td>';
            $html .= '<td style="padding: 8px;">' . $pt->created_at->format('m/d/Y H:i:s') . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        return $html;
    }


    // follow up patients mail end

    protected function generateStrongPassword($length = 12)
    {
        // Characters to include in the password
        $lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
        $uppercaseLetters = strtoupper($lowercaseLetters);
        $numbers = '0123456789';
        $specialChars = '@$!%*#?&';

        // Combine all characters and shuffle them
        $allChars = $lowercaseLetters . $uppercaseLetters . $numbers . $specialChars;
        $shuffled = str_shuffle($allChars);

        // Ensure the password includes at least one character from each category
        $password = substr(str_shuffle($uppercaseLetters), 0, 1)
            . substr(str_shuffle($lowercaseLetters), 0, 1)
            . substr(str_shuffle($numbers), 0, 1)
            . substr(str_shuffle($specialChars), 0, 1)
            . substr($shuffled, 0, $length - 4);

        // Shuffle the generated password to mix the guaranteed characters randomly
        return str_shuffle($password);
    }




    public function sendReminders()
    {
        $today = Carbon::now()->format('Y-m-d'); // Get today's date in the correct format
        $userid = FacadesSession::get('LoginId');
        $reminders = Reminders::where('date', $today)
            ->where('UId', $userid)
            ->where('updated_at', null)
            ->get();

        if ($reminders->isEmpty()) {
            return response()->json(['message' => 'No reminders to send for today.']);
        }

        $userEmail = FacadesSession::get('LoginMail');

        $this->sendEmailWithReminders($reminders, $userEmail);

        $not = new Notifications();
        $not->PtId = null;
        $not->Message = "Your reminder is here : " . $reminders->Reminder;
        $not->type = "Reminders";
        $not->UserId = FacadesSession::get('LoginId');
        $not->UploadedBy = FacadesSession::get('LoginName');
        $not->save();

        foreach ($reminders as $reminder) {
            $reminder->updated_at = Carbon::now(); // Mark as processed
            $reminder->save();
        }

        return response()->json(['message' => 'Reminder sent successfully']);
    }

    protected function sendEmailWithReminders($reminders, $userEmail)
    {
        $mail = new PHPMailer(true);

        try {
            // Mailer configuration
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('support@healthcaredme.com', 'Health Care Reminders');
            $mail->addAddress($userEmail);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Patient Update Reminder';
            $mail->Body = $this->generateEmailRemindersBody($reminders);

            $mail->send();
            echo 'Reminder has been sent.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    protected function generateEmailRemindersBody($reminders)
    {
        $html = '<h2 style="font-family: Arial, sans-serif; color: #333;">Today\'s Reminders</h2>';
        $html .= '<ul style="font-family: Arial, sans-serif; color: #333;">';

        foreach ($reminders as $reminder) {
            $html .= '<li>' . htmlspecialchars($reminder->Reminder) . '</li>';
        }
        $today = Carbon::now()->format('Y-m-d'); // Get today's date in the correct format

        foreach ($reminders as $rem) {
            $no = Reminders::find($rem->id);
            $no->updated_at = $today;
            $no->save();
        }

        $html .= '</ul>';
        return $html;
    }

    function notify($type, $data)
    {
        $subject = '';
        $body = '';
        $recipients = [];
        switch ($type) {
            case 'add_new_patient':
                $usersWithPermission = Users::whereJsonContains('permission', 'New Patient Added')->pluck('email')->toArray();
                $subject = 'New Patient Added';
                $msg = "Patient named {$data['patient_name']} has been added by {$data['added_by']} and assigned to {$data['assigned']} ";
                $body = "<p>A new patient named <strong>{$data['patient_name']}</strong> has been added by <strong>{$data['added_by']} </strong> and assigned to <strong>{$data['assigned']}</strong>.</p>";
                if (!empty($data['checkUpload'])) {
                    $msg .= " with {$data['document_type']} Document.";
                    $body .= "<p>Document type: <strong>{$data['document_type']}</strong> has been uploaded.</p>";
                }
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "New Patient Added";
                break;

            case 'edit_patient':
                $usersWithPermission = Users::whereJsonContains('permission', 'Patient Edited')->pluck('email')->toArray();
                $subject = 'Patient Edited';
                $msg = "Patient named {$data['patient_name']} has been Edited by {$data['added_by']}";
                $body = "<p>Patient named <strong>{$data['patient_name']}</strong> has been Edited by <strong>{$data['added_by']} </strong>.</p>";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Patient Edited";
                break;

            case 'delete_patient':
                $usersWithPermission = Users::whereJsonContains('permission', 'Patient Deleted')->pluck('email')->toArray();
                $subject = 'Patient Deleted.';
                $body = "<p>Patient <strong>{$data['Patient_name']}</strong> has been Deleted by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "Patient {$data['Patient_name']} has been deleted by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Patient Deleted";
                break;



            case 'Assigned_New_Resupply_user':
                $usersWithPermission = Users::whereJsonContains('permission', 'Resupply Patient')->pluck('email')->toArray();
                $subject = 'Resupply Patient Assigned';
                $msg = "Resupply Patient named {$data['pat_name']} has been Asigned to {$data['assigned']}";
                $body = "<p>Resupply patient named <strong>{$data['pat_name']}</strong> has been assigned to <strong>{$data['assigned']}</strong> .</p>";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Resupply Patient";
                break;

            case 'edit_user':
                $usersWithPermission = Users::whereJsonContains('permission', 'User Editeded')->pluck('email')->toArray();
                $subject = "{$data['user_name']} Edited";
                $msg = "User named {$data['user_name']} has been Edited by {$data['added_by']}.";
                $body = "<p>User named <strong>{$data['user_name']}</strong> has been Editeded by <strong>{$data['added_by']} </strong>.</p>";
                if ($data['DeptChange'] == "yes") {
                    $departments = is_array($data['depart']) ? implode(', ', $data['depart']) : $data['depart'];
                    $msg .= " and also edited the department .";
                    $body .= "<p> also edited the department";
                }
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "User Editeded";
                break;

            case 'add_new_document':
                $usersWithPermission = Users::whereJsonContains('permission', 'New Document Added')->pluck('email')->toArray();
                $subject = 'New Document Added';
                $msg = "Document type: {$data['document_type']} has been uploaded on Patient named {$data['patient_name']} has been added by {$data['added_by']}.";
                $body = "<p>Document type: <strong>{$data['document_type']}</strong> has been uploaded on Patient named <strong>{$data['patient_name']}</strong> has been added by {$data['added_by']}.</p>";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "New Document Added";
                break;

            case 'edit_document':
                $usersWithPermission = Users::whereJsonContains('permission', 'Document Edited')->pluck('email')->toArray();
                $subject = 'Document Edited';
                $msg = "Document type: {$data['document_type']}  uploaded on Patient named {$data['patient_name']} has been Edited by {$data['added_by']}.";
                $body = "<p>Document type: <strong>{$data['document_type']}</strong> uploaded on Patient named <strong>{$data['patient_name']}</strong> has been edited by {$data['added_by']}.</p>";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Document Edited";
                break;
            case 'delete_document':
                $usersWithPermission = Users::whereJsonContains('permission', 'Document Deleted')->pluck('email')->toArray();
                $subject = 'Document Deleted';
                $msg = "Document type: {$data['document_type']}  uploaded on Patient named {$data['patient_name']} has been deleted by {$data['added_by']}.";
                $body = "<p>Document type: <strong>{$data['document_type']}</strong> uploaded on Patient named <strong>{$data['patient_name']}</strong> has been deleted by {$data['added_by']}.</p>";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Document Deleted";
                break;

            case 'patient_user_change':
                $usersWithPermission = Users::whereJsonContains('permission', 'Patient User Change')->pluck('email')->toArray();
                $subject = $data['patient_name'] . ' User Change to ' . $data['to_user'];
                $body = "<p>Patient <strong>{$data['patient_name']}</strong> has been transferred from <strong>{$data['from_user']}</strong> to <strong>{$data['to_user']}</strong> by <strong>{$data['added_by']}</strong>..</p>";
                $msg = "Patient {$data['patient_name']} has been transferred from {$data['from_user']} to {$data['to_user']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Patient User Change";
                break;

            case 'patient_Dept_change':
                $usersWithPermission = Users::whereJsonContains('permission', 'Patient Department Change')->pluck('email')->toArray();
                $subject = 'Patient Transfer to ' . $data['to_dept'] . ' .';
                $body = "<p>Patient <strong>{$data['patient_name']}</strong> has been transferred to <strong>{$data['to_dept']}</strong> with status <strong>{$data['status']}</strong> by <strong>{$data['added_by']}</strong>..</p>";
                $msg = "Patient {$data['patient_name']} has been transferred to {$data['to_dept']} with status {$data['status']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Patient Department Change";
                break;

            case 'patient_status_change':
                $usersWithPermission = Users::whereJsonContains('permission', 'Patient Status Change')->pluck('email')->toArray();
                $subject = 'Patient Transfer to ' . $data['to_status'] . ' .';
                $body = "<p>Patient <strong>{$data['patient_name']}</strong> has been transferred from <strong>{$data['from_status']}</strong> to <strong>{$data['to_status']}</strong> by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "Patient {$data['patient_name']} has been transferred from {$data['from_status']} to {$data['to_status']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Patient Status Change";
                break;

            case 'add_new_doctor':
                $usersWithPermission = Users::whereJsonContains('permission', 'Doctor Added')->pluck('email')->toArray();
                $subject = 'New Doctor Added.';
                $body = "<p>New Doctor <strong>{$data['doctor_name']}</strong> has been Added by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "New Doctor {$data['doctor_name']} has been Added by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Doctor Added";
                break;

            case 'edit_doctor':
                $usersWithPermission = Users::whereJsonContains('permission', 'Doctor Edit')->pluck('email')->toArray();
                $subject = 'Doctor Edited.';
                $body = "<p>Doctor <strong>{$data['doctor_name']}</strong> has been Edited by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "Doctor {$data['doctor_name']} has been Edited by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Doctor Edit";
                break;
            case 'delete_doctor':
                $usersWithPermission = Users::whereJsonContains('permission', 'Doctor Deleted')->pluck('email')->toArray();
                $subject = 'Doctor Deleted.';
                $body = "<p>Doctor <strong>{$data['doctor_name']}</strong> has been Deleted by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "Doctor {$data['doctor_name']} has been deleted by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Doctor Deleted";
                break;

            case 'Auth':
                $usersWithPermission = Users::whereJsonContains('permission', 'Authentication')->pluck('email')->toArray();
                $subject = $data['added_by'] . ' ' . $data['user_name'];
                $body = "<p><strong>{$data['added_by']}</strong> has been <strong>{$data['user_name']}</strong>.</p>";
                $msg = "{$data['added_by']} has been {$data['user_name']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "Authentication";
                break;
            case 'add_new_user':
                $usersWithPermission = Users::whereJsonContains('permission', 'User Added')->pluck('email')->toArray();
                $subject = 'New User Added.';
                $body = "<p>New User <strong>{$data['user_name']}</strong> has been Added by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "New User {$data['user_name']} has been Added by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "User Added";
                break;
            case 'ban_user':
                $usersWithPermission = Users::whereJsonContains('permission', 'User Banned')->pluck('email')->toArray();
                $subject = 'User Banned.';
                $body = "<p>User <strong>{$data['user_name']}</strong> has been Banned by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "User {$data['user_name']} has been Banned by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "User Banned";
                break;
            case 'delete_user':
                $usersWithPermission = Users::whereJsonContains('permission', 'User Deleted')->pluck('email')->toArray();
                $subject = 'User Deleted.';
                $body = "<p>User <strong>{$data['user_name']}</strong> has been Deleted by <strong>{$data['added_by']}</strong>.</p>";
                $msg = "User {$data['user_name']} has been Deleted by {$data['added_by']}.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "User Deleted";
                break;

            case 'change_password':
                $usersWithPermission = Users::whereJsonContains('permission', 'User Password Changed')->pluck('email')->toArray();
                $subject = 'User Password Changed.';
                $body = "<p>User <strong>{$data['user_name']}</strong> has Changed Password.</p>";
                $msg = "User {$data['user_name']} has Changed Password.";
                $recipients = array_merge([$data['assigned_users']]);
                $bccRecipients = array_merge($usersWithPermission);
                $ty = "User Password Changed";
                break;

            default:
                return false;
        }

        $not = new Notifications();
        $not->PtId = $data['ptId'];
        $not->Message = $msg;
        $not->type = $ty;
        $not->UserId = $data['UserID'] ?? FacadesSession::get('LoginId');
        $not->UploadedBy = FacadesSession::get('LoginName');
        $not->save();

        $mailResult = $this->sendMail($recipients, $bccRecipients, $subject, $body);

        return $mailResult;
    }




    function sendMail($to, $bcc, $subject, $body, $fromName = 'Notification System')
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host       = 'smtp.stackmail.com';
            $mail->Username   = 'otpverification@healthcaredme.com';
            $mail->Password   = 'Subhan@dg41rq@$';
            $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('support@healthcaredme.com', $fromName);

            $flattenedTo = [];
            array_walk_recursive($to, function ($email) use (&$flattenedTo) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $flattenedTo[] = $email;
                }
            });

            foreach ($flattenedTo as $recipient) {
                $mail->addAddress($recipient);
            }

            $flattenedBcc = [];
            array_walk_recursive($bcc, function ($email) use (&$flattenedBcc) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $flattenedBcc[] = $email;
                }
            });

            foreach ($flattenedBcc as $recipient) {
                $mail->addBCC($recipient);
            }


            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        width: 80%;
                        margin: 0 auto;
                        background-color: #ffffff;
                        padding: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        background-color: #4CAF50;
                        color: #ffffff;
                        padding: 10px 0;
                        text-align: center;
                    }
                    .content {
                        margin: 20px 0;
                    }
                    .footer {
                        text-align: center;
                        margin-top: 20px;
                        font-size: 12px;
                        color: #666666;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>Portal Notification</h1>
                    </div>
                    <div class='content'>
                        $body
                    </div>
                    <div class='footer'>
                        <p>HealthCare DME &copy; All Rights Reserved.</p>
                    </div>
                </div>
            </body>
            </html>
        ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
