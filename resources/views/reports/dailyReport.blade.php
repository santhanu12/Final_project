<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskReport</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Daily Report</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Task</th>
            <th>Start_Date</th>
            <th>End_Date</th>
            <th>Priorty</th>
            <th>Status</th>
            <th>Description</th>
        </tr>
        @foreach ($tasks as $tasks)
            <tr>
                <td>{{ $tasks->name }}</td>
                <td>{{ $tasks->task }}</td>
                <td>{{ $tasks->start_date }}</td>
                <td>{{ $tasks->end_date }}</td>
                <td>{{ $tasks->priorty }}</td>
                <td>{{ $tasks->status }}</td>
                <td>{{ $tasks->description }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
