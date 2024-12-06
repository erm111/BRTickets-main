<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once 'dbconn.php';

function sendTicketEmail($userId, $ticketDetails)
{
    $mail = new PHPMailer(true);

    try {
        // Get user email from database
        global $pdo;
        $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        $userEmail = $user['email'];

        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'uzomannanyere@gmail.com';
        $mail->Password = 'ynuwxcjgkudqqgxe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('uzomannanyere@gmail.com', 'BRTickets');

        $mail->addAddress($userEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your BRTickets Booking Confirmation';

        // Create email body
        $emailBody = "
            <h2>Booking Confirmation</h2>
            <p>Thank you for booking with BRTickets!</p>
            <div style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>
                <h3>Ticket Details:</h3>
                <p><strong>Route:</strong> {$ticketDetails['departure_state']} to {$ticketDetails['arrival_state']}</p>
                <p><strong>Travel Date:</strong> {$ticketDetails['travel_date']}</p>
                <p><strong>Bus Type:</strong> {$ticketDetails['bus_type']}</p>
                <p><strong>Seat Numbers:</strong> {$ticketDetails['seat_numbers']}</p>
                <p><strong>Amount Paid:</strong> ₦{$ticketDetails['total_amount']}</p>
                
                <h3>Next of Kin Details:</h3>
                <p><strong>Name:</strong> {$ticketDetails['next_of_kin_name']}</p>
                <p><strong>Phone:</strong> {$ticketDetails['next_of_kin_phone']}</p>
            </div>
        ";

        $mail->Body = $emailBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: {$mail->ErrorInfo}");
        return false;
    }
}
// Add this at the end of send_mail.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Get the latest ticket details from database
    $stmt = $pdo->prepare("SELECT * FROM tickets WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $ticketDetails = $stmt->fetch();

    $emailSent = sendTicketEmail($_SESSION['user_id'], $ticketDetails);

    header('Content-Type: application/json');
    echo json_encode(['success' => $emailSent]);
}
