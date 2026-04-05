<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $locale === 'kh' ? 'ការទទួលពាក្យ' : 'Application Received' }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #003A46, #006d77); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
        <h1 style="color: white; margin: 0;">
            {{ $locale === 'kh' ? 'សូមស្�欢迎!' : 'Welcome!' }}
        </h1>
    </div>
    
    <div style="background: #f8f9fa; padding: 30px; border-radius: 0 0 8px 8px;">
        <p>{{ $locale === 'kh' ? 'ជំរាបសួរ' : 'Dear' }} <strong>{{ $applicantName }}</strong>,</p>
        
        <p>{{ $locale === 'kh' 
            ? 'យើងបានទទួលពាក្យដាក់ពាក់កណ្តាលរបស់អ្នកសម្រាប់កម្មវិធី' : 'We have received your application for the' }}
            <strong>{{ $programName }}</strong> {{ $locale === 'kh' ? 'នៅ NUMiLaw!' : 'at NUMiLaw!' }}
        </p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center;">
            <p style="margin: 0; color: #666;">{{ $locale === 'kh' ? 'លេខយោង' : 'Your Reference Number' }}</p>
            <h2 style="margin: 10px 0; color: #003A46;">{{ $referenceNumber }}</h2>
        </div>
        
        <p>{{ $locale === 'kh' 
            ? 'សូមរក្សាលេខយោងនេះឱ្យបានសុវត្ថិភាព ដែលអ្នកនឹងត្រូវការដើម្បីតាមដំណើរពាក្យរបស់អ្នក។'
            : 'Please keep this reference number safe - you will need it to track your application status.' }}
        </p>
        
        <p>{{ $locale === 'kh' 
            ? 'ជំរើសបន្ទាប់ យើងនឹងពិនិត្យមើលពាក្យរបស់អ្នក ហើយនឹងផ្ញើសេចក្តីប្រកាសទៅអ្នកតាមអ៊ីមែល។'
            : 'Next steps: We will review your application and send you an email with the decision.' }}
        </p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        
        <p style="font-size: 14px; color: #666;">
            {{ $locale === 'kh' 
                ? 'ប្រសិនបើអ្នកមានសំណួរ សូមទំនាក់ទំនងមកយើងតាមអ៊ីមែល info@numilaw.edu.kh'
                : 'If you have any questions, please contact us at info@numilaw.edu.kh' }}
        </p>
    </div>
    
    <div style="text-align: center; padding: 20px; color: #666; font-size: 12px;">
        <p>NUMiLaw - {{ $locale === 'kh' ? ' បណ្ឌិតសភាច្បាប់ រដ្ឋសាកលវិទ្យាល័យជាតិគ្រប់គ្រង' : 'Faculty of Law, National University of Management' }}</p>
    </div>
</body>
</html>
