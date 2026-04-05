<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $locale === 'kh' ? 'ការធ្វើបច្ចុប្បន្នភាព' : 'Application Update' }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #003A46, #006d77); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0;">
            {{ $locale === 'kh' ? 'ការធ្វើបច្ចុប្បន្នភាព' : 'Application Update' }}
        </h1>
    </div>
    
    <div style="background: #f8f9fa; padding: 30px; border-radius: 0 0 8px 8px;">
        <p>{{ $locale === 'kh' ? 'ជំរាបសួរ' : 'Dear' }} <strong>{{ $applicantName }}</strong>,</p>
        
        <p>{{ $locale === 'kh' ? 'ពាក្យដាក់ពាក់កណ្តាលរបស់អ្នក' : 'Your application' }} ({{ $referenceNumber }}) {{ $locale === 'kh' ? 'បានត្រូវបានធ្វើបច្ចុប្បន្នភាព' : 'has been updated' }}:</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; color: #666;">{{ $locale === 'kh' ? 'ស្ថានភាព' : 'Status' }}:</p>
            <h2 style="margin: 10px 0; color: #003A46; text-transform: capitalize;">
                @if($newStatus === 'accepted')
                    {{ $locale === 'kh' ? 'បានទទួលយក' : 'Accepted' }}
                @elseif($newStatus === 'rejected')
                    {{ $locale === 'kh' ? 'បានច្រាន' : 'Rejected' }}
                @elseif($newStatus === 'under_review')
                    {{ $locale === 'kh' ? 'កំពុងពិនិត្យ' : 'Under Review' }}
                @else
                    {{ $newStatus }}
                @endif
            </h2>
        </div>
        
        @if($adminNotes)
        <div style="background: #e8f4f8; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; color: #666; font-size: 14px;">{{ $locale === 'kh' ? 'មតិ' : 'Notes from Admin' }}:</p>
            <p style="margin: 10px 0 0;">{{ $adminNotes }}</p>
        </div>
        @endif
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        
        <p style="font-size: 14px; color: #666;">
            {{ $locale === 'kh' 
                ? 'អ្នកអាចតាមដំណើរពាក្យរបស់អ្នកតាម ទីនេះ'
                : 'You can track your application status here' }}: 
            <a href="{{ url('/admissions/track') }}" style="color: #006d77;">{{ url('/admissions/track') }}</a>
        </p>
    </div>
    
    <div style="text-align: center; padding: 20px; color: #666; font-size: 12px;">
        <p>NUMiLaw - {{ $locale === 'kh' ? ' បណ្ឌិតសភាច្បាប់' : 'Faculty of Law' }}</p>
    </div>
</body>
</html>
