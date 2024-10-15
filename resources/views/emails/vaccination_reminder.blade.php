<!DOCTYPE html>
<html>
<head>
    <title>Vaccination Reminder</title>
</head>
<body>
    <h1>Vaccination Reminder</h1>
    <p>Dear {{ $schedule->user->name }},</p>
    <p>This is a reminder that you have a vaccination appointment scheduled for:</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($schedule->schedule_date)->format('l, F j, Y') }}</p>
    <p><strong>Location:</strong> {{ $schedule->vaccineCenter->name }}</p>
    <p>Please make sure to arrive on time for your appointment.</p>
    <p>If you have any questions, feel free to contact us.</p>

    <p>Thank you,</p>
    <p>The Vaccination Team</p>
</body>
</html>
