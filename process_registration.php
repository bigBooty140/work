<?php
require_once 'config/database.php';

// Create database connection
$database = new Database();
$conn = $database->getConnection();

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $title = $_POST['selectbox-17037599305407085'] ?? '';
    $first_name = $_POST['contact_firstname'] ?? '';
    $initials = $_POST['text_input-17037466237876250'] ?? '';
    $surname = $_POST['contact_lastname'] ?? '';
    $email = $_POST['contact_email'] ?? '';
    $nationality = $_POST['radio-17037467237924392'] ?? '';
    $sa_id_number = $_POST['text_input-17037468433392946'] ?? '';
    $country = $_POST['selectbox-17037601019284266'] ?? '';
    $proof_of_identification = $_POST['selectbox-17037599969911666'] ?? '';
    $passport_number = $_POST['text_input-17037469113525962'] ?? '';
    $traffic_register_number = $_POST['text_input-17037469292272615'] ?? '';
    $bank_name = $_POST['selectbox-17037601469765598'] ?? '';
    $account_holder_name = $_POST['text_input-1703747476156636'] ?? '';
    $account_number = $_POST['text_input-17037474781664368'] ?? '';
    $branch_name = $_POST['text_input-17037474801003889'] ?? '';
    $branch_code = $_POST['text_input-17037474818383191'] ?? '';
    $race = $_POST['selectbox-17037602759865946'] ?? '';
    $gender = $_POST['selectbox-17037603182803785'] ?? '';
    $date_of_birth = $_POST['date_input-1703748024469416'] ?? '';
    $heard_about_us = $_POST['selectbox-17037603478188271'] ?? '';
    $complex_unit = $_POST['text_input-17037480962499846'] ?? '';
    $street_number = $_POST['text_input-17037481130678525'] ?? '';
    $street_name = $_POST['text_input-17037481271432338'] ?? '';
    $suburb = $_POST['text_input-17037481455067992'] ?? '';
    $town = $_POST['text_input-17037481583976320'] ?? '';
    $postal_code = $_POST['text_input-17037481809166086'] ?? '';
    $province = $_POST['selectbox-17037604275986512'] ?? '';
    $cellphone_number = $_POST['contact_phone'] ?? '';
    $work_telephone_number = $_POST['phone_input-17037483074413198_0'] ?? '';

    // Password
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        header("Location: register.php?message=Passwords do not match&type=danger");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Uploads (same as yours)
    $upload_dir = 'uploads/documents/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $id_document_path = '';
    $traffic_register_letter_path = '';
    $proof_of_address_path = '';
    $banking_document_path = '';

    if (!empty($_FILES['file_input-17037476746001067']['name'])) {
        $id_document_path = $upload_dir . 'id_' . time() . '_' . basename($_FILES['file_input-17037476746001067']['name']);
        move_uploaded_file($_FILES['file_input-17037476746001067']['tmp_name'], $id_document_path);
    }

    if (!empty($_FILES['file_input-17037476765907773']['name'])) {
        $traffic_register_letter_path = $upload_dir . 'traffic_' . time() . '_' . basename($_FILES['file_input-17037476765907773']['name']);
        move_uploaded_file($_FILES['file_input-17037476765907773']['tmp_name'], $traffic_register_letter_path);
    }

    if (!empty($_FILES['file_input-17037476786775550']['name'])) {
        $proof_of_address_path = $upload_dir . 'address_' . time() . '_' . basename($_FILES['file_input-17037476786775550']['name']);
        move_uploaded_file($_FILES['file_input-17037476786775550']['tmp_name'], $proof_of_address_path);
    }

    if (!empty($_FILES['file_input-17037476821786090']['name'])) {
        $banking_document_path = $upload_dir . 'bank_' . time() . '_' . basename($_FILES['file_input-17037476821786090']['name']);
        move_uploaded_file($_FILES['file_input-17037476821786090']['tmp_name'], $banking_document_path);
    }

    try {

        $sql = "INSERT INTO users (
            title, first_name, initials, surname, email, password, nationality, sa_id_number, country,
            proof_of_identification, passport_number, traffic_register_number, bank_name,
            account_holder_name, account_number, branch_name, branch_code,
            id_document_path, traffic_register_letter_path, proof_of_address_path, banking_document_path,
            race, gender, date_of_birth, heard_about_us, complex_unit, street_number,
            street_name, suburb, town, postal_code, province, cellphone_number,
            work_telephone_number, created_at, updated_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW()
        )";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ssssssssssssssssssssssssssssssssss",
            $title, $first_name, $initials, $surname, $email, $hashed_password, $nationality, $sa_id_number, $country,
            $proof_of_identification, $passport_number, $traffic_register_number, $bank_name,
            $account_holder_name, $account_number, $branch_name, $branch_code,
            $id_document_path, $traffic_register_letter_path, $proof_of_address_path, $banking_document_path,
            $race, $gender, $date_of_birth, $heard_about_us, $complex_unit, $street_number,
            $street_name, $suburb, $town, $postal_code, $province, $cellphone_number,
            $work_telephone_number
        );

        if ($stmt->execute()) {
            header("Location: register.php?message=Registration successful&type=success");
        } else {
            header("Location: register.php?message=" . urlencode($stmt->error) . "&type=danger");
        }

        $stmt->close();

    } catch (Exception $e) {
        header("Location: register.php?message=" . urlencode($e->getMessage()) . "&type=danger");
    }

    exit();
}
?>
