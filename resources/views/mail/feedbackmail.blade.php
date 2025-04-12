<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta content='width=device-width, initial-scale=1' name='viewport'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='telephone=no' name='format-detection'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'
        rel='stylesheet'>
    <title>Feedback From Website</title>
    <style>
        p {
            margin: 6px 0;
            font-size: 16px;
            line-height: 20px;
        }

        * {
            box-sizing: border-box;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family: Poppins, sans-serif;'>
    <div class='main-wrapper' style='padding: 30px;'>
        <p><b>Feedback Details:</b></p>
        <p>Dear Admin,</p>

        <p>You have received a new inquiry from the website.</p>
        <p>Please find the details below:</p>
        <ul>
            <li><b>New Inquiry:</b> {!! $data['message'] ?? null !!}</li>
            <li><b>Subject:</b> {!! $data['subject'] ?? null !!}</li>
            <li><b>Sender Name:</b> {{ $data['name'] }}</li>
            <li><b>Sender Email:</b> {{ $data['email'] }}</li>
            <li><b>Date Received:</b> {{ date('d/m/Y', strtotime($data['created_at'])) }}</li>
        </ul>
        <br>
        <p style='font-size: 16px; color: #333;'>Thank you.</p>
    </div>
</body>

</html>
