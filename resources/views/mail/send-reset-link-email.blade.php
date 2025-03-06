<!DOCTYPE html>
<html>

<head>
    <title>Reset Your Password</title>
</head>

<body>

    <div>
        <h2>Password Reset Request</h2>

        <p>Hello,</p>
        <p>You recently requested to reset your password for your account. Click the button below to reset it:</p>

        <p>
            <a href="{{ route('reset-password', ['resetlink' => $reset_link]) }}">Reset Password</a>
        </p>

        <p>If you didn’t request a password reset, please ignore this email.</p>
        <p>This password reset link will expire in 60 minutes.</p>

        <p>Thank you,<br>The Team</p>
    </div>
</body>

</html>
