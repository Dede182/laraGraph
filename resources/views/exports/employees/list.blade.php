
<table>
    <thead>
    <tr>
        @foreach ($columns as $column)
            <th style="text-align:center;font-weight:bold">{{ $column }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td style="text-align:center;">{{ $employee->id }}</td>
            <td style="text-align:center;">{{ $employee->full_name}}</td>
            <td style="text-align:center;">{{ $employee->email }}</td>
            <td style="text-align:center;">{{ $employee->phone }}</td>
            <td style="text-align:center;">{{ $employee->department }}</td>
            <td style="text-align:center;">{{ $employee->user_name}}</td>
            <td style="text-align:center;">{{ $employee->hire_date}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
