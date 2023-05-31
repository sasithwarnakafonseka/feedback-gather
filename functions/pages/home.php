<?php
// If form is submitted...
if (isset($_POST["submit"])) {
    $postName = $_POST["name"];
    // var_dump("INSERT INTO campaigns (name, title, subtitle, rating, emailField, accent, buttonText, tyTitle, tyMessage, created, companyId, userId) VALUES ('" . $postName . "', 'How are we doing?', 'Leave us feedback so we know how we\'re doing.', 1, 1, '#110635', 'Feedback', 'Thank you!', 'Thanks for your feedback. We\'ll continue to improve, based on your suggestions.', NOW()," . $company_id . "," . $user_id . ")");
    $stmt = $conn->prepare("INSERT INTO campaigns (name, title, subtitle, rating, emailField, accent, buttonText, tyTitle, tyMessage, created, companyId, userId) VALUES ('" . $postName . "', 'How are we doing?', 'Leave us feedback so we know how we\'re doing.', 1, 1, '#110635', 'Feedback', 'Thank you!', 'Thanks for your feedback. We\'ll continue to improve, based on your suggestions.', NOW()," . $company_id . "," . $user_id . ")");
    $stmt->execute();

    echo $stmt->error;

    if ($stmt->affected_rows > 0) {
        redirect($url . '/campaign/' . $conn->insert_id . '/editor');
    }
}