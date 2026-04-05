@extends('admin.layouts.app')

@section('title', 'AI Content Generator')

@push('styles')
<style>
    .form-floating label {
        color: #6b7280;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #003A46;
        box-shadow: 0 0 0 0.2rem rgba(0,58,70,0.15);
    }
    
    .output-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .output-card h6 {
        color: #003A46;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .output-card textarea {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        font-size: 14px;
    }
    
    .copy-btn {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">AI Content Generator</h1>
            <p class="text-muted">Generate bilingual content for announcements, events, and news</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form id="contentGeneratorForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Content Type</label>
                            <select class="form-select" id="contentType" name="type">
                                <option value="announcement">Announcement</option>
                                <option value="event_description">Event Description</option>
                                <option value="news">News Article</option>
                                <option value="program_info">Program Information</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Brief Notes</label>
                            <textarea class="form-control" id="prompt" name="prompt" rows="6" 
                                      placeholder="Enter key points, topics, or rough ideas you want the AI to expand on..."></textarea>
                            <small class="text-muted">Be as specific as possible for better results</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100" id="generateBtn">
                            <i class="bi bi-magic me-2"></i>
                            Generate Content
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-7">
            <div id="outputSection" style="display: none;">
                <!-- English Output -->
                <div class="output-card position-relative">
                    <button type="button" class="btn btn-sm btn-outline-secondary copy-btn" onclick="copyToClipboard('outputEn')">
                        <i class="bi bi-clipboard"></i> Copy
                    </button>
                    <h6>English</h6>
                    <div class="mb-2">
                        <label class="form-label small text-muted">Title</label>
                        <input type="text" class="form-control" id="outputTitleEn" readonly>
                    </div>
                    <div>
                        <label class="form-label small text-muted">Content</label>
                        <textarea class="form-control" id="outputBodyEn" rows="6" readonly></textarea>
                    </div>
                </div>
                
                <!-- Khmer Output -->
                <div class="output-card position-relative">
                    <button type="button" class="btn btn-sm btn-outline-secondary copy-btn" onclick="copyToClipboard('outputKh')">
                        <i class="bi bi-clipboard"></i> Copy
                    </button>
                    <h6>Khmer (ខ្មែរ)</h6>
                    <div class="mb-2">
                        <label class="form-label small text-muted">Title</label>
                        <input type="text" class="form-control" id="outputTitleKh" readonly>
                    </div>
                    <div>
                        <label class="form-label small text-muted">Content</label>
                        <textarea class="form-control" id="outputBodyKh" rows="6" readonly></textarea>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Review and edit the generated content before using it in your publications.
                </div>
            </div>
            
            <div id="loadingSection" class="text-center py-5" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Generating content...</p>
            </div>
            
            <div id="emptySection" class="text-center py-5 text-muted">
                <i class="bi bi-magic" style="font-size: 48px; opacity: 0.3;"></i>
                <p class="mt-3">Generated content will appear here</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('contentGeneratorForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const prompt = document.getElementById('prompt').value;
    const type = document.getElementById('contentType').value;
    const generateBtn = document.getElementById('generateBtn');
    
    if (!prompt.trim()) {
        alert('Please enter some notes for content generation');
        return;
    }
    
    document.getElementById('emptySection').style.display = 'none';
    document.getElementById('loadingSection').style.display = 'block';
    document.getElementById('outputSection').style.display = 'none';
    generateBtn.disabled = true;
    
    try {
        const response = await fetch('{{ route("ai.generate-content") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ prompt, type })
        });
        
        const data = await response.json();
        
        if (data.result) {
            try {
                const parsed = JSON.parse(data.result);
                
                document.getElementById('outputTitleEn').value = parsed.title_en || '';
                document.getElementById('outputBodyEn').value = parsed.body_en || '';
                document.getElementById('outputTitleKh').value = parsed.title_kh || '';
                document.getElementById('outputBodyKh').value = parsed.body_kh || '';
                
                document.getElementById('loadingSection').style.display = 'none';
                document.getElementById('outputSection').style.display = 'block';
            } catch (e) {
                document.getElementById('outputBodyEn').value = data.result;
                document.getElementById('loadingSection').style.display = 'none';
                document.getElementById('outputSection').style.display = 'block';
            }
        } else {
            alert('Failed to generate content. Please try again.');
            document.getElementById('emptySection').style.display = 'block';
            document.getElementById('loadingSection').style.display = 'none';
        }
    } catch (error) {
        alert('An error occurred. Please try again.');
        document.getElementById('emptySection').style.display = 'block';
        document.getElementById('loadingSection').style.display = 'none';
    }
    
    generateBtn.disabled = false;
});

function copyToClipboard(field) {
    let text = '';
    if (field === 'outputEn') {
        text = 'Title: ' + document.getElementById('outputTitleEn').value + '\n\n' + 
               document.getElementById('outputBodyEn').value;
    } else {
        text = 'Title: ' + document.getElementById('outputTitleKh').value + '\n\n' + 
               document.getElementById('outputBodyKh').value;
    }
    
    navigator.clipboard.writeText(text).then(() => {
        alert('Copied to clipboard!');
    });
}
</script>
@endpush
@endsection
