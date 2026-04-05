@extends('layouts.public')

@section('title', 'Application Submitted')

@section('description', 'Your application has been successfully submitted. Learn about next steps in the admission process.')

@section('content')
<!-- Hero Section -->
<section class="bg-success text-white py-5">
<br><br><br>    <div class="container">
        <div class="text-center">
            <div class="mb-4">
                <i class="bi bi-check-circle-fill fs-1"></i>
            </div>
            <h1 class="display-5 fw-bold mb-3">
                {{ app()->getLocale() === 'km' ? 'ដាក់ពាក្យដោយជោគជ័យ!' : 'Application Submitted Successfully!' }}
            </h1>
            <p class="lead mb-0">
                {{ app()->getLocale() === 'km' ? 
                    'អរគុណសម្រាប់ការចាប់អារម្មណ៍របស់អ្នកក្នុងការចូលរៀននៅមហាវិទ្យាល័យច្បាប់របស់យើង។' : 
                    'Thank you for your interest in joining our law school.' }}
            </p>
        </div>
    </div>
</section>

<!-- Confirmation Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-envelope-check text-success fs-1"></i>
                            </div>
                        </div>
                        
                        <h2 class="h3 mb-3">{{ app()->getLocale() === 'km' ? 'អ្វីដែលកើតឡើងបន្ទាប់?' : 'What Happens Next?' }}</h2>
                        
                        <p class="lead mb-4">
                            {{ app()->getLocale() === 'km' ? 
                                'សំណើដាក់ពាក្យរបស់អ្នកត្រូវបានទទួលដោយជោគជ័យ។ ក្រុមការងាររបស់យើងនឹងពិនិត្យឡើងវិញហើយទាក់ទងអ្នកក្នុងរយៈពេល 2-3 ថ្ងៃធ្វើការ។' : 
                                'Your application has been successfully received. Our team will review it and contact you within 2-3 business days.' }}
                        </p>

                        <!-- Application Reference Number -->
                        <div class="alert alert-info mb-4">
                            <h5 class="alert-heading">
                                <i class="bi bi-hash"></i> 
                                {{ app()->getLocale() === 'km' ? 'លេខសំណើ' : 'Reference Number' }}
                            </h5>
                            <p class="mb-0">
                                <strong>{{ session('application_reference', 'N/A') }}</strong>
                            </p>
                            <small>{{ app()->getLocale() === 'km' ? 'សូមរក្សាទុកលេខសំណើនេះសម្រាប់ឯកសារអនាគត' : 'Please save this reference number for future correspondence' }}</small>
                        </div>

                        <!-- Next Steps Timeline -->
                        <div class="row text-start mb-4">
                            <div class="col-md-12">
                                <h5 class="text-center mb-3">{{ app()->getLocale() === 'km' ? 'ជំហានបន្ទាប់' : 'Next Steps' }}</h5>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px;">
                                            <strong>1</strong>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ app()->getLocale() === 'km' ? 'ការពិនិត្យដំបូង' : 'Initial Review' }}</h6>
                                        <small class="text-muted">{{ app()->getLocale() === 'km' ? '2-3 ថ្ងៃធ្វើការ' : '2-3 business days' }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px;">
                                            <strong>2</strong>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ app()->getLocale() === 'km' ? 'ប្រឡងចូល' : 'Entrance Exam' }}</h6>
                                        <small class="text-muted">{{ app()->getLocale() === 'km' ? 'តាមកាលកំណត់' : 'By appointment' }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px;">
                                            <strong>3</strong>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ app()->getLocale() === 'km' ? 'ការសំភាស' : 'Interview' }}</h6>
                                        <small class="text-muted">{{ app()->getLocale() === 'km' ? 'ប្រសិនបើត្រូវការ' : 'If required' }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 12px;">
                                            <strong>4</strong>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ app()->getLocale() === 'km' ? 'ការសម្រេច' : 'Final Decision' }}</h6>
                                        <small class="text-muted">{{ app()->getLocale() === 'km' ? 'ក្នុងរយៈពេល 2 សប្តាហ៍' : 'Within 2 weeks' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-light rounded p-4 mb-4">
                            <h5 class="mb-3">{{ app()->getLocale() === 'km' ? 'មានសំណួរ?' : 'Have Questions?' }}</h5>
                            <div class="row text-start">
                                <div class="col-md-4">
                                    <strong>{{ app()->getLocale() === 'km' ? 'អ៊ីមែល:' : 'Email:' }}</strong><br>
                                    admission@lawuniversity.edu
                                </div>
                                <div class="col-md-4">
                                    <strong>{{ app()->getLocale() === 'km' ? 'ទូរស័ព្ទ:' : 'Phone:' }}</strong><br>
                                    +855 23 456 789
                                </div>
                                <div class="col-md-4">
                                    <strong>{{ app()->getLocale() === 'km' ? 'ម៉ោងធ្វើការ:' : 'Office Hours:' }}</strong><br>
                                    Mon-Fri: 8AM-5PM
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('public.admission.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-house"></i> 
                                {{ app()->getLocale() === 'km' ? 'ទំព័រដើម' : 'Home' }}
                            </a>
                            <a href="{{ route('public.academic-programs.index') }}" class="btn btn-primary">
                                <i class="bi bi-mortarboard"></i> 
                                {{ app()->getLocale() === 'km' ? 'មើលកម្មវិធីផ្សេងទៀត' : 'View Other Programs' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</section>

<!-- Additional Resources -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="h4">{{ app()->getLocale() === 'km' ? 'ធនធានបន្ថែម' : 'Additional Resources' }}</h3>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-book-fill text-primary fs-1 mb-3"></i>
                        <h5 class="card-title">{{ app()->getLocale() === 'km' ? 'សៀវភៅសិស្ស' : 'Student Handbook' }}</h5>
                        <p class="card-text text-muted small">
                            {{ app()->getLocale() === 'km' ? 'ស្វែងយល់ពីគោលការណ៍និងបទបញ្ជារបស់យើង' : 'Learn about our rules and regulations' }}
                        </p>
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            {{ app()->getLocale() === 'km' ? 'ទាញយក' : 'Download' }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calculator-fill text-success fs-1 mb-3"></i>
                        <h5 class="card-title">{{ app()->getLocale() === 'km' ? 'ការគណនាថ្លៃរៀន' : 'Tuition Calculator' }}</h5>
                        <p class="card-text text-muted small">
                            {{ app()->getLocale() === 'km' ? 'គណនាថ្លៃរៀនសម្រាប់កម្មវិធីរបស់អ្នក' : 'Calculate tuition for your program' }}
                        </p>
                        <a href="#" class="btn btn-outline-success btn-sm">
                            {{ app()->getLocale() === 'km' ? 'គណនា' : 'Calculate' }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill text-info fs-1 mb-3"></i>
                        <h5 class="card-title">{{ app()->getLocale() === 'km' ? 'ជួបសិស្សបច្ចុប្បន្ន' : 'Current Students' }}</h5>
                        <p class="card-text text-muted small">
                            {{ app()->getLocale() === 'km' ? 'ជួបនិងសួរសិស្សដែលកំពុងសិក្សា' : 'Meet and ask current students' }}
                        </p>
                        <a href="#" class="btn btn-outline-info btn-sm">
                            {{ app()->getLocale() === 'km' ? 'ជួប' : 'Connect' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
// Print functionality
function printConfirmation() {
    window.print();
}

// Share functionality (if needed)
document.addEventListener('DOMContentLoaded', function() {
    // Track successful application submission
    if (typeof gtag !== 'undefined') {
        gtag('event', 'application_submitted', {
            'event_category': 'admission',
            'event_label': 'form_completion'
        });
    }
});
</script>
@endpush
@endsection