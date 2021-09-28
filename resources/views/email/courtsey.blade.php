<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>

    <style>
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

       
    </style>
</head>
<body >

<section class="wrap" style="color:#000000;font-family:'Roboto', Arial,sans-serif;font-size:16px;line-height:26px;text-align:left;font-weight: 300;background: rgb(239 239 239);padding: 20px;min-height: 100vh;">
    <div class="container" style="width: 530px;
            margin: 0 auto;
            background: #fff;
            padding: 40px 70px;
            box-shadow: 0 2px 9px rgba(0,0,0,0.15), 0 2px 2px rgba(0,0,0,0.12);
            ">


        <div class="logo-head" style="text-align:center;">
            <img src="{{ asset('images/email/logo.png') }}" alt="" style=" width: 50%; margin-bottom: 15px; ">
        </div>

        <h3 style="color:#000000; font-family:'Roboto', Arial,sans-serif; font-size: 22px;
            line-height: 20px;
            text-align: left;
            font-weight: 400;">Dear {{$name}}</h3>

        <div class="content" style="color:#000000; font-family:'Roboto', Arial,sans-serif; font-size:16px; line-height:26px; text-align:left">
            <p>Please accept our sincerest thanks and gratitude for your recent visit at COCO BEAUTY LOUNGE located at Chevron Renaissance Shopping Center. It was
                truly our upmost pleasure to serve you.
            </p>

            <p>Here at Coco Beauty Lounge, we strive to provide the highest level of service possible. We hope that your experince with us was a pleasant one and that we can be of service
                to you again in the future. As a valued customer, your comments and opinions are very important yo us.
                If you have any concerns, we hope that we will bring them to our attention.
            </p>

            <p>
                If there are any other ways that er can serve you better at this time or in the future, please let us know. Thank you once again for your trust and business.
                We will look forward to serving you in the future.
            </p>

            <p>
                As a valued customer, please accept our $5 voucher to be redeemed at your next appointment.Please speak to one of our friendly staff instore.
            </p>

            <p>Lastly, if you would like to take a minute to like and post a review on our social media below, we would so appreciate it</p>


        </div>


    </div>

    <div class="content-footer" style="text-align: center;  background: #f6f6f6;width: 530px;
        margin: 0 auto;
        padding: 40px 70px; font-weight: 300; box-shadow: 0 2px 9px rgba(0,0,0,0.15), 0 2px 2px rgba(0,0,0,0.12);" >

        <div class="coco-social" style="margin-bottom: 20px;">
            <a href="" target="_blank" style="text-decoration: none;"> <img src="{{ asset('images/email/logo-facebook.svg') }}" alt="" style="width:20px; margin-right:10px;"> </a>
            <a href="" target="_blank" style="text-decoration: none;"> <img src="{{ asset('images/email/logo-instagram.svg') }}" alt="" style="width:20px; "> </a>

        </div>

        <p style="margin: 4px 0; margin-top: 0">COCO Beauty Lounge</p>
        <p style="margin: 4px 0;">Chevron Renaissance Shopping Center</p>
        <p style="margin: 4px 0;">Shop 21A/3240 Surfers Paradise BLVD, Surfers Paradise, 4217, QLD </p>
        <p style="margin: 4px 0;">0416422507</p>
    </div>

</section>

</body>
</html>
