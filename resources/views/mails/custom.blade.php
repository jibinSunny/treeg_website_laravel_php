<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Doc</title>
</head>
<body>
        Sender Name <h4><i>{{ $mail->name }}</i></h4>
        Phone No : <h5><i>{{ $mail->phone }}</i></h5>
        Sender Email : <h5><i>{{ $mail->email }}</i></h5>
       
         
        <p><u>{{ $mail->subject }}</u></p>
         
        <div>
        <p><b>{{ 'Mail Content' }}</b></p>
        <p>{{ $mail->content }}</p>
        </div>
        <br/><br/>
       
</body>
</html>