    <!-- <base href="/public"> -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="robots" content="noindex, nofollow">
        <link rel="stylesheet" href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" />
        <link href="<?php echo e(asset('assets/vendor/fonts/circular-std/style.css')); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/css/style.css')); ?>" />
        <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
    "
            rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo e(asset('assets/images/datamanagmentlogo.jpg')); ?>" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <title>HEALTHCARE | <?php echo $__env->yieldContent('title'); ?></title>
    </head>
    <style>
        table {
            font-size: 10px;
        }



        .search-box {
            position: relative;
            /*width: 100%;*/
        }

        .search-input {
            padding: 2px 25px;
            border: 1px solid #ccc;
            width: 100%;
            height: 30px;
            border: none;
            margin: 0;
            box-shadow: none;
            border-radius: 5px;
            background-color: #fffefe;
            border: 1px solid #ccc;

        }

        .search-icon,
        .clear-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .search-icon {
            left: 15px;
        }

        .clear-icon {
            right: 15px;
            display: none;
            /* Hide clear icon initially */
        }

        .search-input:valid~.clear-icon {
            display: block;
        }
    </style>

    <body>
        <div class="dashboard-main-wrapper">
            <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img class="user-avatar-lg rounded-circle"
                            src="<?php echo e(asset('assets/images/Headlogo.jpg')); ?>" height="805" width="100"
                            alt="logo"></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Dropdown
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                        $userId = Session::get('LoginId');
                        $username = Session::get('LoginName');
                        $usermail = Session::get('loginmail');
                        $addPer = Session::get('LoginAdd');
                        $editPer = Session::get('LoginEdit');
                        $deletePer = Session::get('LoginDelete');
                        $code = Session::get('LoginUserCode');
                        $progressCheck = Session::get('LoginProgress');
                        $cancelPer = Session::get('LoginCancel');
                        $holdId = Session::get('HoldLoginId');
                        $ViewAsUserPer = Session::get('LoginviewUser');
                        $BulkChangePer = Session::get('LoginBulkPer');
                    ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <input class="form-control" type="text" value="Welcome, <?php echo e($username); ?>"
                                        readonly />
                                </div>
                            </li>
                            <li class="nav-item dropdown notification">
                                <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                    <li>
                                        <div class="notification-title"> Notification</div>
                                        <div class="slimScrollDiv"
                                            style="position: relative; overflow: hidden; width: auto; height: auto;">
                                            <div class="notification-list"
                                                style="overflow-y: auto; max-height: 400px; width: auto;">
                                                <div class="list-group">
                                                    <?php $__currentLoopData = $noti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $not): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(url('PatientDetail', $not->PtId)); ?>"
                                                            class="list-group-item list-group-item-action"
                                                            style="transition: background-color 0.3s ease;">
                                                            <div class="notification-info"
                                                                style="padding: 10px; font-size: 14px;">
                                                                <div class="notification-list-user-block txt-sm">
                                                                    <span
                                                                        style="font-size: 12px;"><?php echo e($not?->Message); ?></span>.
                                                                    <div class="notification-date"
                                                                        style="font-size: 12px; color: #888;">
                                                                        <span class="notification-list-user-name"
                                                                            style="font-weight: bold;"><?php echo e($not?->UploadedBy); ?></span>
                                                                        <?php echo e($not?->created_at); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="slimScrollBar"
                                                style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 69px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 181.686px;">
                                            </div>
                                            <div class="slimScrollRail"
                                                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                            </div>
                                        </div>

                                    </li>
                                    <li>
                                        <div class="list-footer"> <a href="<?php echo e(url('notifications')); ?>">View all
                                                notifications</a></div>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown nav-user">
                                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                        src="<?php echo e(asset('assets/images/datamanagmentlogo.jpg')); ?>" alt
                                        class="user-avatar-md rounded-circle" /></a>
                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                    aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name"><?php echo e($username); ?></h5>
                                    </div>
                                    <a class="dropdown-item" href="<?php echo e(url('ChangePassword')); ?>"><i
                                            class="fas fa-lock mr-2"></i>Change Password</a>
                                    <a class="dropdown-item" href="<?php echo e(url('logout')); ?>"><i
                                            class="fas fa-power-off mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="nav-left-sidebar sidebar  ">
                <div class="menu-list">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column ">
                                <li class="nav-divider">Status</li>
                                <ul class="nav flex-column">
                                    <a class="nav-link active" href="<?php echo e(url('/')); ?>">
                                        <li class="nav-item  small-text small-badge" style="font-size: 12px;">All
                                            &nbsp; <span class="badge badge-light" style="font-size: 12px;">(
                                                <?php echo e($pt); ?> )</span></li>
                                    </a>


                                    <?php
                                        // Define arrays for pending and complete statuses
                                        $pendingStatuses = [
                                            'waiting medical records',
                                            'waiting for rx',
                                            'waiting for auth',
                                            'hold',
                                            'ready for dispense',
                                            'scheduled',
                                        ];
                                        $completeStatuses = [
                                            'sent for billing',
                                            'waiting ins. payment',
                                            'waiting copay payment',
                                            'closed',
                                        ];

                                        // Initialize variables to check the presence of statuses in categories
                                        $hasPendingStatuses = false;
                                        $hasCompleteStatuses = false;

                                        // Initialize counters for each category
                                        $pendingCount = 0;
                                        $completeCount = 0;
                                        $notifyCount = 0;
                                        $cancelCount = 0;
                                        $holdCount = 0;
                                        $closedCount = 0;

                                        // Get all statuses in a single query
                                        $statusIds = $drs->pluck('Order_Status')->unique();
                                        $statusModels = \App\Models\Status::whereIn('id', $statusIds)
                                            ->get()
                                            ->keyBy('id');

                                        foreach ($drs as $patient) {
                                            if ($patient->request != null && $patient->request != 0) {
                                                $notifyCount++;
                                            }

                                            if ($patient->request == 1) {
                                                $cancelCount++;
                                            }

                                            if ($patient->request == 2) {
                                                $holdCount++;
                                            }

                                            if ($patient->request == 3) {
                                                $closedCount++;
                                            }

                                            // Get the status model from the preloaded statusModels array
                                            $statusModel = $statusModels->get($patient->Order_Status);
                                            if (!$statusModel) {
                                                continue;
                                            } // Skip if status not found

                                            $statusName = strtolower($statusModel->Status);

                                            if (in_array($statusName, $pendingStatuses)) {
                                                $pendingCount++;
                                                $hasPendingStatuses = true;
                                            } elseif (in_array($statusName, $completeStatuses)) {
                                                $completeCount++;
                                                $hasCompleteStatuses = true;
                                            }
                                        }

                                    ?>


                                    <?php $__currentLoopData = $st; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $cou = 0;
                                            foreach ($drs as $pt) {
                                                if ($sts->id == $pt->Order_Status) {
                                                    $cou++;
                                                }
                                            }
                                        ?>
                                        <?php if($sts->order == 2): ?>
                                            <?php if($hasPendingStatuses): ?>
                                                <li class="nav-item bg-light" style="font-size: 12px;">
                                                    <a class="nav-link status-name" href="#"
                                                        style="font-size: 12px;" data-toggle="collapse"
                                                        aria-expanded="false" data-target="#submenu-9-p"
                                                        aria-controls="submenu-1">Pending &nbsp; <span
                                                            class="badge badge-light small-badge"
                                                            style="font-size: 12px;">(<?php echo e($pendingCount); ?>)</span></a>
                                                    <div id="submenu-9-p" class="collapse submenu bg-light">
                                                        <ul class="nav flex-column">
                                                            <?php $__currentLoopData = $st; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $cou = 0;
                                                                    foreach ($drs as $pt) {
                                                                        if ($stas->id == $pt->Order_Status) {
                                                                            $cou++;
                                                                        }
                                                                    }
                                                                ?>
                                                                <?php if(in_array(strtolower($stas->Status), $pendingStatuses)): ?>
                                                                    <li class="nav-item" style="font-size: 12px;">
                                                                        <a class="nav-link bg-light txt-sm status-name"
                                                                            href="<?php echo e(url('StatusPatient', $stas->id)); ?>"
                                                                            style="font-size: 12px;">
                                                                            <?php echo e($stas->Status); ?> &nbsp; <span
                                                                                class="badge badge-light"
                                                                                style="font-size: 12px;">(<?php echo e($cou); ?>)</span>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if(!in_array(strtolower($sts->Status), $pendingStatuses) && !in_array(strtolower($sts->Status), $completeStatuses)): ?>
                                            <li class="nav-item" style="font-size: 12px;">
                                                <a class="nav-link bg-light" style="font-size: 12px;"
                                                    href="<?php echo e(url('StatusPatient', $sts->id)); ?>">
                                                    <?php echo e($sts->Status); ?> &nbsp; <span class="badge badge-light"
                                                        style="font-size: 12px;">(<?php echo e($cou); ?>)</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($sts->order == 8): ?>
                                            <?php if($hasCompleteStatuses): ?>
                                                <li class="nav-item bg-light">
                                                    <a class="nav-link" href="#" data-toggle="collapse"
                                                        aria-expanded="false" data-target="#submenu-9-c"
                                                        aria-controls="submenu-1" style="font-size: 12px;">Completed
                                                        &nbsp; <span class="badge badge-light"
                                                            style="font-size: 12px;">(<?php echo e($completeCount); ?>)</span></a>
                                                    <div id="submenu-9-c" class="collapse submenu bg-light">
                                                        <ul class="nav flex-column">
                                                            <?php $__currentLoopData = $st; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $cou = 0;
                                                                    foreach ($drs as $pt) {
                                                                        if ($stas->id == $pt->Order_Status) {
                                                                            $cou++;
                                                                        }
                                                                    }
                                                                ?>
                                                                <?php if(in_array(strtolower($stas->Status), $completeStatuses)): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link bg-light"
                                                                            href="<?php echo e(url('StatusPatient', $stas->id)); ?>"
                                                                            style="font-size: 12px;">
                                                                            <?php echo e($stas->Status); ?> &nbsp; <span
                                                                                class="badge badge-light"
                                                                                style="font-size: 12px;">(<?php echo e($cou); ?>)</span>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>



                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                                    <?php
                                        $userR = Session::get('LoginRole');
                                    ?>

                                    <?php if($userR == '1' || $userR == '2' || $addPer == 'on' || $editPer == 'on' || $deletePer == 'on'): ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(url('PatientAdd')); ?>">Add Patient</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($userR == '2' || $progressCheck == 'on'): ?>
                                        <a class="nav-link" href="<?php echo e(url('progress')); ?>">
                                            <li class="nav-item"><i
                                                    class="fa-solid fa-bars-progress"></i>Progress</span></li>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($userR == '2' || $userR == '1'): ?>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="#" data-toggle="collapse"
                                                aria-expanded="false" data-target="#submenu-19"
                                                aria-controls="submenu-1"><i class="fa-solid fa-bell"></i>Request
                                                Dashboard ( <?php echo e($notifyCount); ?> )</a>
                                            <div id="submenu-19" class="collapse submenu"
                                                style="background-color: white;">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?php echo e(url('RequestPatients/1')); ?>">Cancel (
                                                            <?php echo e($cancelCount); ?> )</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?php echo e(url('RequestPatients/2')); ?>">Hold (
                                                            <?php echo e($holdCount); ?> )</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?php echo e(url('RequestPatients/3')); ?>">Closed (
                                                            <?php echo e($closedCount); ?> )</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php endif; ?>


                                    <?php if($userR == '0'): ?>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="#" data-toggle="collapse"
                                                aria-expanded="false" data-target="#submenu-19"
                                                aria-controls="submenu-1"><i class="fa-solid fa-bell"></i>Request
                                                Dashboard ( <?php echo e($notifyCount); ?> )</a>
                                            <div id="submenu-19" class="collapse submenu"
                                                style="background-color: white;">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?php echo e(url('RequestPatients/1')); ?>">Cancel (
                                                            <?php echo e($cancelCount); ?> )</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?php echo e(url('RequestPatients/2')); ?>">Hold (
                                                            <?php echo e($holdCount); ?> )</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?php echo e(url('RequestPatients/3')); ?>">Closed (
                                                            <?php echo e($closedCount); ?> )</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <li class="nav-item ">
                                        <a class="nav-link" href="#" data-toggle="collapse"
                                            aria-expanded="false" data-target="#submenu-1"
                                            aria-controls="submenu-1"><i class="fa-solid fa-people-roof"></i>Manage
                                        </a>
                                        <div id="submenu-1" class="collapse submenu bg-light" style>
                                            <ul class="nav flex-column">
                                                <?php if($userR == '1' || $userR == '2' || $deletePer == 'on' || $editPer == 'on'): ?>
                                                    <li class="nav-item ">
                                                        <a href="#" class="nav-link" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-4"
                                                            aria-controls="submenu-1"><i class="fa fa-bed"></i>Manage
                                                            Patients</a>
                                                        <div id="submenu-4" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">

                                                                <?php if($userR == '1' || $userR == '2' || $deletePer == 'on' || $editPer == 'on'): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"
                                                                            href="<?php echo e(url('PatientList')); ?>">Patient's
                                                                            List</a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($userR == '2' || $ViewAsUserPer == 'on' || $BulkChangePer == 'on'): ?>

                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-1-1"
                                                            aria-controls="submenu-1"><i
                                                                class="fa fa-fw fa-user-circle"></i>Manage User</a>
                                                        <div id="submenu-1-1" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <?php if($userR == '2'): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"
                                                                            href="<?php echo e(url('UserAdd')); ?>">Add User</a>
                                                                    </li>
                                                                <?php endif; ?>

                                                                <?php if($userR == '2' || $ViewAsUserPer == 'on' || $BulkChangePer == 'on'): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"
                                                                            href="<?php echo e(url('UserList')); ?>">Maintain
                                                                            User</a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>


                                                <?php if($userR == '1' || $userR == '2'): ?>
                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-9"
                                                            aria-controls="submenu-1"><i
                                                                class="fa-solid fa-cart-flatbed"></i>Manage
                                                            Orders</a>
                                                        <div id="submenu-9" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('Orders')); ?>">Maintain Order</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-2"
                                                            aria-controls="submenu-1"><i
                                                                class="fa fa-building"></i>Manage
                                                            Departments</a>
                                                        <div id="submenu-2" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('DepartmentAdd')); ?>">Add
                                                                        Department</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('DepartmentList')); ?>">Maintain
                                                                        Department</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-29"
                                                            aria-controls="submenu-1"><i
                                                                class="fa-solid fa-building-user"></i>Manage
                                                            Sub Department</a>
                                                        <div id="submenu-29" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('addSubDept')); ?>">Add Sub
                                                                        Department</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('SubDepartList')); ?>">Maintain Sub
                                                                        Department</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-3"
                                                            aria-controls="submenu-1"><i
                                                                class="fa fa-hourglass-start"></i>Manage Status</a>
                                                        <div id="submenu-3" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('StatusAdd')); ?>">Add Status</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('StatusList')); ?>">Maintain
                                                                        Status</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-31"
                                                            aria-controls="submenu-1"><i
                                                                class="fa-solid fa-coins"></i>Maintain</a>
                                                        <div id="submenu-31" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('InventoryItemList')); ?>">Inventory</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('purchaseOrderList')); ?>">Purchase
                                                                        Order</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('RetailSale')); ?>">Retail Sale</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('serialNumberList')); ?>">Serial
                                                                        Number</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('PriceCodeList')); ?>">Price
                                                                        Code</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('VendorList')); ?>"> Vendor</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('ManufacturerList')); ?>">
                                                                        Manufacture</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('InsuranceCompanyList')); ?>">
                                                                        Insurances</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('NewDoctorList')); ?>">Doctor</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('TaxList')); ?>">Tax</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('LocationList')); ?>">
                                                                        Locations</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('InsuranceGroupList')); ?>">
                                                                        Insurance Group</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('InvoiceFormList')); ?>">Invoice
                                                                        Form</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('AbilityPayerList')); ?>">Ability
                                                                        Payer</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('InsuranceTypeList')); ?>">Insurance
                                                                        Type</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('FormPOSTypeList')); ?>">Form POS
                                                                        Type</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('ICDTenList')); ?>">ICD 10</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('PreferredNotesList')); ?>">
                                                                        Preferred Notes</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('WarehouseList')); ?>">
                                                                        Warehouse</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('MissingInformation')); ?>">
                                                                        Missing Information</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="<?php echo e(url('Reports')); ?>">
                                                                        Reports</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('OrdersList')); ?>"> Orders</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('InvoicesList')); ?>"> Invoices</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="<?php echo e(url('PendingInvoicesList')); ?>">
                                                                        Pending Invoices List</a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>



                                                <?php if($userR == '1' || $userR == '2' || $addPer == 'on'): ?>
                                                    <li class="nav-item ">
                                                        <a class="nav-link" href="#" data-toggle="collapse"
                                                            aria-expanded="false" data-target="#submenu-5"
                                                            aria-controls="submenu-1"><i
                                                                class="fa fa-stethoscope"></i>Manage Doctor</a>
                                                        <div id="submenu-5" class="collapse submenu"
                                                            style="background-color: white;">
                                                            <ul class="nav flex-column">
                                                                <?php if($userR == '1' || $userR == '2' || $addPer == 'on' || $editPer == 'on' || $deletePer == 'on'): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"
                                                                            href="<?php echo e(url('DoctorAdd')); ?>">Add Doctor
                                                                            Office</a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if($userR == '1' || $userR == '2' || $deletePer == 'on' || $editPer == 'on'): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"
                                                                            href="<?php echo e(url('DoctorList')); ?>">Maintain
                                                                            Doctor Office</a>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($userR == '2'): ?>
                                                    <a class="nav-link" href="<?php echo e(url('documentList')); ?>">
                                                        <li class="nav-item"><i
                                                                class="fa-solid fa-bars-progress"></i>Manage
                                                            Documents</span></li>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if($userR == '2' || $progressCheck == 'on'): ?>
                                                    <a class="nav-link" href="<?php echo e(url('progress')); ?>">
                                                        <li class="nav-item"><i
                                                                class="fa-solid fa-bars-progress"></i>Progress</span>
                                                        </li>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if($userR == '2'): ?>
                                                    <a class="nav-link" href="<?php echo e(url('LogsList')); ?>">
                                                        <li class="nav-item"><i
                                                                class="fa-brands fa-slack"></i>Logs</span></li>
                                                    </a>
                                                    <a class="nav-link" href="<?php echo e(url('backup&restore')); ?>">
                                                        <li class="nav-item"><i class="fa fa-database"></i>Backup
                                                            Database</span></li>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if($userR == '0'): ?>
                                                    <a class="nav-link" href="<?php echo e(url('HistoryList')); ?>">
                                                        <li class="nav-item"><i
                                                                class="fa-solid fa-book-medical"></i>Work&nbsp;History</span>
                                                        </li>
                                                    </a>
                                                <?php endif; ?>


                                            </ul>
                                        </div>
                                    </li>
                                    <?php if(Session::has('HoldLoginId')): ?>
                                        </a><a class="nav-link" href="<?php echo e(url('BackToLogin', $holdId)); ?>">
                                            <li class="nav-item"><i class="fa-solid fa-right-from-bracket"></i>Back To
                                                Admin</span></li>
                                        </a>
                                    <?php else: ?>
                                        <a class="nav-link" href="<?php echo e(url('logout')); ?>">
                                            <li class="nav-item"><i
                                                    class="fa-solid fa-right-from-bracket"></i>Logout</span></li>
                                        </a>
                                    <?php endif; ?>
                                    <br> <br> <br> <br> <br>
                                </ul>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
<?php /**PATH D:\purana xammp\htdocs\ecommerce-laravel\data-mangment2\resources\views/layout/Head.blade.php ENDPATH**/ ?>