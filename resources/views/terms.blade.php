@section('title', 'Terms & Conditions')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Terms of Service, Privacy Policy, User Agreement</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Home
                      </li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">



                <div class="row">
                    <div class="col">
                        <div class="card">

                        
                        <div class="card-body p-0">

<br>
<p class="p-3"> Healthcare DME SAAS Portal Legal Terms

Introduction - Welcome to Healthcare DME,<br> a specialized SaaS platform designed to support Durable Medical Equipment Software (DMEPOS Software). This document combines the Terms of Use, Privacy Policy, and User Agreement, which govern your access to and use of our services available at portal.healthcaredme.com. By accessing or using our platform, you acknowledge and agree to these terms and commit to comply with all applicable laws and regulations. The protection of your data and privacy is paramount to us, especially given the sensitive nature of healthcare information.
<br><br>
1. Terms of Use 1.1 - Services Description: Healthcare DME provides DMEPOS SAAS Software for the use of DME Companies & Its employees, contractors, & subcontractors. 1.2 - User Responsibilities: Users are expected to use the platform responsibly, adhering to all guidelines and ensuring the accuracy of data entered into the system. 1.3 - Intellectual Property: All content and services provided by Healthcare DME are the exclusive property of Healthcare DME, except for user-generated content, for which users retain ownership but grant Healthcare DME a license to use & be the beneficial owner of. 1.4 - Termination and Suspension: Accounts may be suspended or terminated for violations of these terms, with processes outlined for appeal and data retention. 1.5 - Liability Limitations: Healthcare DME disclaims all warranties to the extent permitted by law and limits its liability for damages. 
<br><br>
2. Privacy Policy 2.1 - Information Collection and Use: Healthcare DME personal and health-related information necessary to provide our services, with strict adherence to confidentiality and security standards. 2.2 - Data Sharing and Disclosure: Information will only be shared under specific conditions, such as with user consent or for legal compliance, ensuring protection under HIPAA and other regulations. 2.3 - Data Security: Robust security measures are in place to protect user data, including encryption and secure data storage practices. 2.4 - User Rights: Users have rights to access, correct, and delete their information, with procedures detailed for exercising these rights. 
<br><br>
3. User Agreement 3.1 - Account Requirements: Users must register for an account, meeting all specified requirements, and are responsible for maintaining the security of their account information. 3.2 - Service Usage: The platform must be used in compliance with all applicable healthcare laws and regulations, including HIPAA. 3.3 - Fees and Payments: Any applicable fees, payment terms, and refund policies are clearly outlined. 3.4 - Termination: The terms under which the service agreement can be terminated by either party are specified, including data retention post-termination. 3.5 - Dispute Resolution: The process for resolving disputes arising from the use of the platform is detailed, emphasizing arbitration or applicable jurisdiction. 
<br><br>
Modifications and Contact Information
<br><br><br>
This document along with its policies may be updated or modified to reflect changes in our services or legal requirements. Users will be notified of significant changes. For questions or concerns about these terms, the Privacy Policy, or the User Agreement, please contact us at info@healthcaredme.com, 2911 Carpenter Road. Ann Arbor, MI 48108, or (734) 975-6668.
</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@include('layout.footer')



<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Date Range</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
  <form id="dateRangeForm" action="{{ url('MainReport') }}" method="GET" target="_blank">
                    <div class="form-group">
                        <label for="startDate">Start Date:</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date:</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
                </div>
            </div>
        </div>
    </div>




<script>
    $(document).ready(function() {
        logAction("Home Page Loaded");
    });
</script>
