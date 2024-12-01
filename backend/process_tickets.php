<?php
session_start();
require_once 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingDetails = json_decode($_POST['bookingDetails'], true);
    $selectedSeats = json_decode($_POST['selectedSeats'], true);
    
    try {
        $sql = "INSERT INTO tickets (
            user_id, 
            departure_state, 
            arrival_state, 
            travel_date, 
            bus_type,
            seat_numbers,
            total_seats,
            luggage,
            total_amount,
            next_of_kin_name,
            next_of_kin_relationship,
            next_of_kin_email,
            next_of_kin_phone,
            next_of_kin_address
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $busType = $bookingDetails['busType'];
        $basePrice = ($busType === 'hiance') ? 23000 : 25000;
        $luggageFee = $bookingDetails['luggage'] ? 5000 : 0;
        $totalAmount = ($basePrice * count($selectedSeats)) + $luggageFee;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_SESSION['user_id'],
            $bookingDetails['departure'],
            $bookingDetails['arrival'],
            $bookingDetails['date'],
            $busType,
            json_encode($selectedSeats),
            count($selectedSeats),
            $bookingDetails['luggage'],
            $totalAmount,
            $_POST['next_of_kin_name'],
            $_POST['next_of_kin_relationship'],
            $_POST['next_of_kin_email'],
            $_POST['next_of_kin_phone'],
            $_POST['next_of_kin_address']
        ]);

        // Store next of kin details in session for ticket printing
        $_SESSION['kinDetails'] = [
            'name' => $_POST['next_of_kin_name'],
            'relationship' => $_POST['next_of_kin_relationship'],
            'email' => $_POST['next_of_kin_email'],
            'phone' => $_POST['next_of_kin_phone'],
            'address' => $_POST['next_of_kin_address']
        ];

        header("Location: payment.php");
    } catch(PDOException $e) {
        $_SESSION['error'] = "Booking failed. Please try again.";
        header("Location: ticket_processing.php");
    }
}