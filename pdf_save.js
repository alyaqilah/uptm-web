document.getElementById('downloadBtn').addEventListener('click', function () {
    var element = document.getElementById('resume');
    var Name = document.getElementById('name').dataset.name;
    var opt = {
        margin:       0.05,
        filename:     `${Name}-CV.pdf`,
        image:        { type: 'jpg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    var info = `
            <html>
                <head>
                    <title>Home</title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
                    <style>
                        .sidebar {
                            height: 100%;
                            width: 200px;
                            position: fixed;
                            top: 0;
                            left: 0;
                            background-color: indigo;
                            padding-top: 20px;
                        }
                        .sidebar a {
                            padding: 15px;
                            text-decoration: none;
                            font-size: 18px;
                            color: white;
                            display: block;
                        }
                        .sidebar a:hover {
                            background-color: #575757;
                        }
                        .content {
                            margin-left: 220px;
                            padding: 20px;
                        }
                        footer {
                            background-color: indigo;
                            color: white;
                            padding: 10px 0;
                            text-align: center;
                            position: fixed;
                            bottom: 0;
                            width: 100%;
                            left: 0;
                        }
                        .table-container {
                            margin-top: 20px;
                        }
                        .table th {
                            background-color: indigo;
                            color: white;
                        }
                        </style>
                </head>
                <body>
                    ${element.innerHTML}
                </body>
            </html>
        `;
    // New Promise-based usage:
    html2pdf().set(opt).from(info).save();
});