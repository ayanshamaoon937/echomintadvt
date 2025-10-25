<?php
header('Content-Type: application/json');

require_once __DIR__ . '/sendmailfunction.php';

// Basic input sanitation
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$service = isset($_POST['service_needed']) ? trim($_POST['service_needed']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$consent = isset($_POST['consent']) ? $_POST['consent'] : '';

// Validate required fields
if ($name === '' || $email === '' || $phone === '' || $service === '' || $message === '' || $consent !== '1') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields are required and consent must be given.']);
    exit;
}

// Build professional email template
$subject = 'New Contact Form Submission - EchoMint Advertising';
$body = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8f9fa;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #8C462F 0%, #A0522D 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .info-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #8C462F;
        }
        .info-row {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }
        .info-row:last-child {
            margin-bottom: 0;
        }
        .info-label {
            font-weight: 600;
            color: #8C462F;
            min-width: 120px;
            margin-right: 15px;
        }
        .info-value {
            color: #333333;
            flex: 1;
            word-break: break-word;
        }
        .message-section {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .message-section h3 {
            color: #8C462F;
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .message-content {
            color: #333333;
            line-height: 1.7;
            white-space: pre-wrap;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .footer a {
            color: #8C462F;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .timestamp {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 20px;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }
            .header {
                padding: 20px 15px;
            }
            .header h1 {
                font-size: 20px;
            }
            .content {
                padding: 20px 15px;
            }
            .info-section {
                padding: 15px;
            }
            .info-row {
                flex-direction: column;
                margin-bottom: 15px;
            }
            .info-label {
                min-width: auto;
                margin-right: 0;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎯 New Contact Form Submission</h1>
            <p>EchoMint Advertising - Dubai</p>
        </div>
        
        <div class="content">
            <div class="timestamp">
                📅 Received: ' . date('F j, Y \a\t g:i A T') . '
            </div>
            
            <div class="info-section">
                <div class="info-row">
                    <div class="info-label">👤 Full Name:</div>
                    <div class="info-value">' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">📧 Email:</div>
                    <div class="info-value">
                        <a href="mailto:' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '" style="color: #8C462F; text-decoration: none;">
                            ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '
                        </a>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">📱 Phone:</div>
                    <div class="info-value">
                        <a href="tel:' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '" style="color: #8C462F; text-decoration: none;">
                            ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '
                        </a>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">🎨 Service Needed:</div>
                    <div class="info-value">
                        <strong style="color: #8C462F;">' . htmlspecialchars($service, ENT_QUOTES, 'UTF-8') . '</strong>
                    </div>
                </div>
            </div>
            
            <div class="message-section">
                <h3>💬 Customer Message</h3>
                <div class="message-content">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</div>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>EchoMint Advertising</strong></p>
            <p>📍 Essa Saleh, al Gurg building - office 203, 16th St - Al Hamriya - Dubai - UAE</p>
            <p>📧 <a href="mailto:info@echomintadvertising.com">info@echomintadvertising.com</a></p>
            <p style="margin-top: 15px; font-size: 12px; color: #999;">
                This email was automatically generated from your website contact form.
            </p>
        </div>
    </div>
</body>
</html>';

try {
    // Send to requested address with reply-to set to submitter
    sendemailsmtp('info@echomintadvt.com', $body, $subject, $email, $name);
    echo json_encode(['success' => true, 'message' => 'Submitted']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error']);
}

?>


