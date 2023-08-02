<?php
require_once 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["filename"]) && isset($_POST["employee_id"])) {
        $filename = $_POST["filename"];
        $employee_id = $_POST["employee_id"];

        // Specify the folder where you want to save the QR code in the same directory as save_qrcode.php
        $saveFolderPath = __DIR__ . "/qrcodes/";

        // Check if the folder exists, if not, create it
        if (!is_dir($saveFolderPath)) {
            mkdir($saveFolderPath, 0777, true);
        }

        $qrCode = new BaconQrCode\Renderer\Image\Png();
        $qrCode->setText($employee_id);
        $qrCode->setSize(500);
        $qrCode->setMargin(0);

        // Save the QR code image to a file
        $filePath = $saveFolderPath . $filename;
        $qrCode->save($filePath);

        // Check if the file was saved successfully
        if (file_exists($filePath)) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
