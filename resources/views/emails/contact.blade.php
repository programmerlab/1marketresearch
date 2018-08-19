<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Enquiry</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="
    background: #fff;
    font-size: 14px;
    border: 0px solid #ccc;
    padding: 20px;
    font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif
"> 
 
  <div>Hello {{$content['first_name']}},</div>
  <p style="font-size: 13px">Thank you for getting in touch!</p>
  <div style="font-size: 13px">We appreciate you contacting us. We try to respond as soon as possible, so one of our Customer Service colleagues will  get back to you within a few hours. 
  </div>
  <p style="font-size: 13px">
  Report Name : {{$content['report_name'] or ''}}
  </p>
  <p style="font-size: 13px">
  Report Link :{{$content['report_link'] or ''}}
  </p> 
  <p>Have a great day ahead!</p>
  <p>
    <b>Thanks </b><br>
    {{$content['greeting']}}

  </p>
</body>
</html>
