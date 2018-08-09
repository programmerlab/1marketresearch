<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Enquiry</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="
    background: #fbfbfb;
    font-size: 14px;
    border: 0px solid #ccc;
    padding: 20px;
    font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif
"> 
 
  <div>Hello Admin,</div>
  <p> You have new message! </p>

  @foreach($content['data'] as $key => $result)
  <p style="font-size: 13px"> {{ ucfirst(str_replace('_',' ',$key)) }} : {{ $result}} </p>
    @endforeach 
  <p style="font-size: 13px">
  Report Name : {{$content['report_name'] or ''}}
  </p>
  <p style="font-size: 13px">
  Report Link :{{$content['report_link'] or ''}}
  </p> 
  
</body>
</html>
