<?php
include_once "user_sidebar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f4f4f4;
        }

        .content {
            margin-left: 400px; 
            padding: 20px;
            width: calc(80% - 270px);
            border-radius: 10px;
        }

        .content h2 {
            background-color: #1c2254;
            padding: 10px;
            border-radius: 10px;
            color: white;
        }

        .faq {
            margin-top: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            background-color: #1c2254;
            border-radius: 10px;
        }

        .faq h3 {
            margin-top: 10px;
            margin-bottom: 10px;
            color: #1c2254;
            margin: 25px
        }

        .faq p {
            margin-bottom: 10px;
            color: white;
            margin: 25px;
            justify-content: center;

        }

        .faq p:first-child {
            margin-top: 0;
        }

        .faq p:last-child {
            margin-bottom: 0;
        }

        .faq i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="content">
    <h2> FAQs</h2>
    <div class="faq">
        <h3>System FAQs</h3>
        <p><i class="fas fa-question-circle"></i><b> How do I register to vote?</b></p>
        <p><i class="fas fa-info-circle"></i> To register to vote, please visit the voter registration section on our website.</p>
        
        <p><i class="fas fa-question-circle"></i><b> Can I change my registered information?</b></p>
        <p><i class="fas fa-info-circle"></i> Yes, you can update your registered information by visiting the profile section after logging in.</p>
        
        
        <p><i class="fas fa-question-circle"></i> <b>How are the candidates selected?</b></p>
        <p><i class="fas fa-info-circle"></i> Candidates are selected through a nomination process organized by the election committee.</p>
        
        <p><i class="fas fa-question-circle"></i><b> Is my vote anonymous?</b></p>
        <p><i class="fas fa-info-circle"></i> Yes, the voting system ensures that your vote remains anonymous.</p>
    </div>
    <div class="faq">
        <h3>Voting Process FAQs</h3>
        <p><i class="fas fa-question-circle"></i> <b>How do I cast my vote?</b></p>
        <p><i class="fas fa-info-circle"></i> To cast your vote, log in to your account and follow the instructions on the ballot page.</p>
        
        <p><i class="fas fa-question-circle"></i> <b>Can I change my vote after submitting?</b></p>
        <p><i class="fas fa-info-circle"></i> No, once you submit your vote, it cannot be changed. Please review your selections carefully before submitting.</p>
        
        <p><i class="fas fa-question-circle"></i> <b>How are the election results determined?</b></p>
        <p><i class="fas fa-info-circle"></i> The election results are determined based on the total number of votes cast for each candidate or option.</p>
        
        <p><i class="fas fa-question-circle"></i><b> Is there a deadline for voting?</b></p>
        <p><i class="fas fa-info-circle"></i> Yes, the voting period will be specified, and you must cast your vote within that timeframe.</p>
        
        <p><i class="fas fa-question-circle"></i><b> What if I encounter technical issues while voting?</b></p>
        <p><i class="fas fa-info-circle"></i> If you encounter any technical issues, please contact our support team for assistance.</p>
    </div>
</div>

</body>
</html>
