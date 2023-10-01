<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate PDF</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; background-color: #f2f2f2; margin: 0; padding: 0;">
        <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff;">
            <h1 style="font-size: 24px; margin-bottom: 20px;">Dear {{$name}},</h1>
            <p style="font-size: 16px; margin-bottom: 20px;">Greetings from {{$organizer_name}}!!</p>
            <p style="font-size: 16px; margin-bottom: 20px;">Please find attached Certificate of Appreciation : #{{$certificate_number}}</p>
            <p style="font-size: 16px; margin-bottom: 20px;">Thank you for attending our program, and we look forward to hearing more from you.</p>
            <p style="font-size: 16px; margin-bottom: 20px;">Follow our website <a href="{{$website_url}}" style="color: #007BFF; text-decoration: underline;">here</a> to know more about our future events.</p>
            <p style="font-size: 16px;">Regards,</p>
            <p style="font-size: 14px; margin-top: 20px; color: #777777;">{{$head_name}}<br>CHIEF ORGANIZER</p>
        </div>
    </div>
</body>
</html>