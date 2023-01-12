<html>
    <head>
    <title>How to disable previous dates in date picker using JQuery - devnote.in</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body>
    <h1>How to disable previous dates in date picker using JQuery</h1>
    Date : <input id="date_picker" type="date">
    <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date_picker').attr('min',today);
    </script>
</body>

</html>
