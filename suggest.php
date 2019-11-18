<?php
// check for request method
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
    $category = tirm(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING));
    $format = trim(filter_input(INPUT_POST, "format", FILTER_SANITIZE_STRING));
    $year = trim(filter_input(INPUT_POST, "year", FILTER_SANITIZE_STRING));
    $details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

    // validation checker
    if ($name == "" || $email == "" || $category == "" || $title == "" || $format == "") {
        $error_msg =  "Please fill in rerquires fields: Name, Email, Title, Category and Format";
    }
    // check for robots
    if (!isset($error_msg) && $_POST['address'] != "") {
        $error_msg = "bad form input";
    }

    //TODO: Send emaiL
    require("include/PHPMailer.php");
    $mail = new PHPMailer;
    if (!isset($error_msg) && !$mail->ValidateAddress($email)) {
        $error_msg = "email is not valid";
    }

    if (!isset($error_msg)) {
        // message body
        $msg_body = "";
        $msg_body .= "Name: " . $name . "\n";
        $msg_body .= "Email: " . $email . "\n";
        $msg_body .= "Title: " . $title . "\n";
        $msg_body .= "Category: " . $category . "\n";
        $msg_body .= "Format: " . $format . "\n";
        $msg_body .= "Year: " . $year . "\n";
        $msg_body .= "Other Details: " . $details . "\n";

        // Recipients
        $mail->setForm($email, $name);
        $mail->addAddress('fadyelgendy2017@gmail.com', 'Fady');

        //content 
        $mail->isHTML(false);
        $mail->Subject = "Suggest: " . $title;
        $mail->Body = $msg_body;

        if ($mail->send()) {
            heade("location:suggest.php?status=thanks");
            exit;
        } else {
            $error_msg =  "Message could not be sent";
            $error_msg .= "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}

$pageTitle = "Suggest A media Item";
$section = "suggest";
include("include/header.php");
?>

<div class="section page">
    <div class="wrapper">
        <h1>Suggest Media Item</h1>
        <?php if (isset($_GET['status']) && $_GET['status'] == "thanks") {
            echo "<p>Thanks for this email. I&rsquo;ll checkout your suggestion shortly.</p>";
            echo $msg_body;
        } else {
            if (isset($error_msg)) {
                echo "<p class='message'" . $error_msg . "</p>";
            } else { ?>
        <p>If you think there is something i&rsquo;m missing let me know! compelete the form to sen me an email</p>
        <?php } ?>
        <form action="suggest.php" method="post">
            <table>
                <tr>
                    <th><label for="name">Name (required)</label></th>
                    <td><input type="text" name="name" id="name" value="<?php if (isset($name)) {
                                                                                echo $name;
                                                                            } ?>"></td>
                </tr>
                <tr>
                    <th><label for="email">Email (required)</label></th>
                    <td><input type="email" name="email" id="email" value="<?php if (isset($email)) {
                                                                                    echo $email;
                                                                                } ?>"></td>
                </tr>
                <tr>
                    <th><label for="tite">Title (required)</label>
                    <td><input type="text" name="title" id="title" value="<?php if (isset($title)) {
                                                                                    echo $title;
                                                                                } ?>"></td>
                </tr>
                <tr>
                    <th><label for="category">Category (required)</label></th>
                    <td>
                        <select name="category" id="category">
                            <option selected disabled>select category</option>
                            <option value="books" <?php if (isset($category) && $category == "books") {
                                                            echo " selected";
                                                        } ?>>Books</option>
                            <option value="movies" <?php if (isset($category) && $category == "movies") {
                                                            echo " selected";
                                                        } ?>>Movies</option>
                            <option value="music" <?php if (isset($category) && $category == "music") {
                                                            echo " selected";
                                                        } ?>>Music</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th><label for="format">Format (required)</label></th>
                    <td>
                        <select name="format" id="format">
                            <option selected disabled>choose format</option>
                            <optgroup label="Books">
                                <option value="ebook" <?php if (isset($format) && $format == "ebook") {
                                                                echo " selected";
                                                            } ?>>E-book</option>
                                <option value="hardback" <?php if (isset($format) && $format == "hardback") {
                                                                    echo " selected";
                                                                } ?>>Hardback</option>
                                <option value="paperback" <?php if (isset($format) && $format == "paperback") {
                                                                    echo " selected";
                                                                } ?>>Paperback</option>
                            </optgroup>
                            <optgroup label="Movies">
                                <option value="blue-ray" <?php if (isset($format) && $format == "blue-ray") {
                                                                    echo " selected";
                                                                } ?>>blue-ray</option>
                                <option value="hd" <?php if (isset($format) && $format == "hd") {
                                                            echo " selected";
                                                        } ?>>HD</option>
                                <option value="dvd" <?php if (isset($format) && $format == "dvd") {
                                                            echo " selected";
                                                        } ?>>DVD</option>
                            </optgroup>
                            <optgroup label="Music">
                                <option value="cassette" <?php if (isset($format) && $format == "cassette") {
                                                                    echo " selected";
                                                                } ?>>Cassette</option>
                                <option value="cd" <?php if (isset($format) && $format == "cd") {
                                                            echo " selected";
                                                        } ?>>CD</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="year">Year</label></th>
                    <td><input type="text" name="year" id="year" value="<?php if (isset($email)) {
                                                                                echo $email;
                                                                            } ?>"></td>
                </tr>
                <tr>
                    <th><label for="details">Suggest item details</label></th>
                    <td><textarea name="details" id="details"><?php if (isset($details)) {
                                                                        echo htmlspecialcahrs($details);
                                                                    } ?></textarea></td>
                </tr>
                <tr style="display:none;">
                    <th><label for="address">address</label></th>
                    <td><textarea name="address" id="address"></textarea></td>
                </tr>
            </table>
            <input type="submit" value="Send">
        </form>
        <?php } ?>
    </div>
</div>
<?php include("include/footer.php") ?>