<!doctype html>
<html lang="`en`">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>

    <style>

        .wrapper {
            width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
        }
    </style>
</head>
<body>



<section class="wrapper" >
    <div class="container">
        <div class="content-head" style=" text-align: center; ">
            <img src="{{ asset('images/email/logo-icon.png') }}" alt="" style=" width: 60px; margin-bottom: 15px; ">


            <img src="{{ asset('images/email/birthday-gif.gif') }}" alt="" style=" width: 100%; height: 300px; object-fit: cover; ">
        </div>

        <div class="content-body" style="margin-top: 60px;">
            <h4 style="font-family:helvetica,sans-serif;text-decoration:none;color:#333;margin:0;padding:0;font-weight: 100;">Dear <span style="font-weight: 600;" > {{$name}},</span></h4>

            <h3 class="subject" style="font-family:helvetica,sans-serif;font-weight: 800; text-decoration:none;color:#333;margin: 30px auto;padding:0;text-align: center;text-transform: uppercase;  font-size: 24px;width: 70%;margin-bottom:50px;">Thankyou for choosing us.</h3>

            <p style="font-family:helvetica,sans-serif;text-decoration:none;color:#333;font-weight:300;display:block;font-size:16px;line-height:24px;margin:1em 0;padding:0">
               Thankyou!!!!!!!!!!!</span>
            </p style="font-family:helvetica,sans-serif;text-decoration:none;color:#333;font-weight:300;display:block;font-size:16px;line-height:24px;margin:1em 0;padding:0">

            <p style="font-family:helvetica,sans-serif;text-decoration:none;color:#333;font-weight:300;display:block;font-size:16px;line-height:24px;margin:1em 0;padding:0">We are glad, you choosed us. </p>


            <p style="font-family:helvetica,sans-serif;text-decoration:none;color:#333;font-weight:300;display:block;font-size:16px;line-height:24px;margin:1em 0;padding:0">We would love to see you soon.</p>
        </div>

        <div class="content-footer" style="margin-top: 40px; font-family:helvetica,sans-serif;text-decoration:none;color:#333;font-weight:300;display:block;font-size: 14px;line-height: 20px;padding:0;">
            <p style="margin: 8px 0;">Sincerely,</p>
            <p style="margin: 8px 0;">COCO Beauty Lounge</p>
            <p style="margin: 8px 0;">Chevron Renaissance Shopping Center</p>
            <p style="margin: 8px 0;">Shop 21A/3240 Surfers Paradise BLVD, Surfers Paradise, 4217, QLD </p>
            <p style="margin: 8px 0;">0416422507</p>
        </div>
    </div>
</section>
</body>
</html>
