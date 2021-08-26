<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <style>

        #certificate-body {
            width: 612pt;
            height: 792pt;
        }


        img.border-background {
            width: 612pt;
            height: 792pt;
            position: absolute;
            top: 0;
            left:0;
            z-index: -1;
        }

        div.coat-of-arms {
            width: 131pt;
            height: 149pt;
            margin: auto;


        }
        img.coat-of-arms {
            width: 130pt;
            height: 148pt;
            margin-top: 96pt;

        }

        img.template-text {
            width: 413pt;
            height: 432pt;
            top: 260pt;
            left: 103pt;
            position: absolute;
            background-color: rgba(0,0,0,0);

        }

        .recipient-name, .ceremony-date {
            font-size: 28pt;
            background-color: rgba(0,0,0,0);

        }
        div.recipient-name {
            width: 612pt;
            text-align: center;
            position: absolute;
            top: 340pt;

        }
        div.ceremony-date {
            width: 612pt;
            text-align: center;
            position: absolute;
            top: 455pt;

        }


    </style>



    <title>Printable Keepsake Invitation</title>
</head>
<body>
<div id="certificate-body">
    <div class="border-background">
        <img class="border-background" src="{{url('img/border-background.png')}}">
    </div>
    <div class="coat-of-arms">
        <img class="coat-of-arms" src="{{url('img/coat-of-arms.png')}}">
    </div>

    <div class="template-text">
        <img class="template-text" src="{{url('img/template-text.png')}}">
    </div>

    <div class="recipient-name">
        {{$name}}
    </div>

    <div class="ceremony-date">
        {{$date->format('l jS \of F Y')}}
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var opt = {
        filename: 'LSA-invitation.pdf'
    }

    html2pdf().set(opt).from(document.getElementById('certificate-body')).save();
</script>

</body>
</html>
